<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\ContactTask;
use App\ContactNote;
use App\ContactBusinessInformation;
use App\ContactBrokerInformation;
use App\ContactLoanInformation;
use App\ContactAssignedUser;
use App\ContactCallTracker;
use App\ContactHistory;
use App\CompanyUser;
use App\Companies;
use App\Workflow;
use App\Stage;
use App\EventType;
use App\EmailTemplate;
use App\MailMessaging;
use App\User;


use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'contacts';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $idl_contacts = UserHelper::getIdleContacts();
            $idle_contacts_count = 0;
            $idle_contacts       = array();
            if(!empty($idl_contacts)) {
                $idle_contacts_count = $idl_contacts['total_idle'];
                $idle_contacts       = $idl_contacts['idle_data'];
            }

            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);             

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);             

            return $next($request);     
        });                 
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  
        $user_id      = Auth::user()->id;

        if($search_by != '' && $search_field != '') {
            $contact_query = Contact::query();

            if($search_by != '' && $search_field != '') {

            	if( $search_by == 'name' ){

            		/*$contact_query = $contact_query->where('contacts.firstname', 'like', '%' . $search_field . '%')->orWhere('contacts.lastname', 'like', '%' . $search_field . '%');
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $contact_query = $contact_query->where('user_id', '=', Auth::user()->id);
                    } */

                    $user_id       = Auth::user()->id;
                    $contact_query = $contact_query->leftJoin('contact_assigned_users', 'contacts.id','=', 'contact_assigned_users.contact_id');
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $contact_query = $contact_query->where('contact_assigned_users.user_id','=', $user_id);
                    }
                    $contact_query = $contact_query->where('contacts.firstname', 'like', '%' . $search_field . '%')->orWhere('contacts.lastname', 'like', '%' . $search_field . '%');

                }else{

                    $contact_query = $contact_query->leftJoin('contact_assigned_users', 'contacts.id','=', 'contact_assigned_users.contact_id');
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $contact_query = $contact_query->where('contact_assigned_users.user_id','=', $user_id);
                    }                    
            		$contact_query = $contact_query->where('contacts.'.$search_by, 'like', '%' . $search_field . '%');

                }

                $contact = $contact_query = $contact_query->orderBy('contacts.created_at', 'desc')->paginate(15);
            }            
        } else {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {       
       
                /*$contact = Contact::where('user_id','=', $user_id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(15); */

                $contact = Contact::leftJoin('contact_assigned_users', 'contacts.id','=', 'contact_assigned_users.contact_id')
                                ->where('contact_assigned_users.user_id','=', $user_id)
                                ->orderBy('contacts.created_at', 'desc')
                                ->paginate(15);

            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $contact = Contact::orderBy('created_at', 'desc')->paginate(15);  
            }else{

                /*$contact = Contact::where('user_id','=', $user_id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(15); */

                $contact = Contact::leftJoin('contact_assigned_users', 'contacts.id','=', 'contact_assigned_users.contact_id')
                                ->where('contact_assigned_users.user_id','=', $user_id)
                                ->orderBy('contacts.created_at', 'desc')
                                ->paginate(15);                        
            }            
        }

        $stages    = Stage::all();
        $event_types = EventType::all();
        $call_log_activity_history = ContactCallTracker::all();
        $event_types   = EventType::all();

        $emailTemplates = EmailTemplate::where('user_id', '=', $user_id)->get();
        if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
            $contacts = Contact::where('user_id','=', $user_id)->get();
        }else{
            $contacts = Contact::all();
        }
        
        if(UserHelper::isAdminUser(Auth::user()->group_id)) {
            return view('contact.index',[
                'contact' => $contact,
                'search_field' => $search_field,
                'stages' => $stages,
                'event_types' => $event_types,
                'call_log_activity_history' => $call_log_activity_history,
                'event_types' => $event_types,
                'emailTemplates' => $emailTemplates,
                'contacts' => $contacts
            ]); 
        } else {
            return view('contact.cindex',[
                'contact' => $contact,
                'search_field' => $search_field,
                'stages' => $stages,
                'event_types' => $event_types,
                'call_log_activity_history' => $call_log_activity_history,
                'event_types' => $event_types,
                'emailTemplates' => $emailTemplates,
                'contacts' => $contacts
            ]); 
        }

    } 

    public function create()
    {
        $stages    = Stage::all();
        $companies = Companies::all();

        $company_users_by_group = array();
        $company_users = CompanyUser::all();

        if($company_users) {
            $inc = 1;
            foreach($company_users as $company_u) {
                if(isset($company_u->company->name)) {
                    $company_users_by_group[$company_u->company->name][$inc]['user_id'] = $company_u->user_id;
                    $company_users_by_group[$company_u->company->name][$inc]['company_id'] = $company_u->company_id;
                    $company_users_by_group[$company_u->company->name][$inc]['name'] = $company_u->user->firstname . " " . $company_u->user->lastname;
                }

            $inc++;
            }
        }   

        $users_other_groups = array();
        $users_all_others = User::where('group_id','!=',2)->get();  

        if($users_all_others) {
            $inc = 1;
            foreach($users_all_others as $g_user) {
                if(isset($g_user->group->name)) {
                    $users_other_groups[$g_user->group->name][$inc]['user_id'] = $g_user->id;
                    $users_other_groups[$g_user->group->name][$inc]['name']    = $g_user->firstname . " " . $g_user->lastname;
                } else {
                    $users_other_groups['others'][$inc]['user_id'] = $g_user->id;
                    $users_other_groups['others'][$inc]['name']    = $g_user->firstname . " " . $g_user->lastname;
                }
                
            $inc++;
            }
        } 

        if(UserHelper::isCompanyUser(Auth::user()->group_id) || UserHelper::isRTRUser(Auth::user()->group_id)) {

            $company_id   = 0;
            $user_id      = Auth::user()->id;
            $company_user = CompanyUser::where('user_id','=', $user_id)->first();
            if($company_user) {
                $company_id  = $company_user->company_id;
            }

            return view('contact.c_create', [
                'stages' => $stages,
                'companies' => $companies,
                'company_id' => $company_id,
                'company_users_by_group' => $company_users_by_group,
                'users_other_groups' => $users_other_groups,
            ]);   
        }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
            return view('contact.create', [
                'stages' => $stages,
                'companies' => $companies,
                'company_users_by_group' => $company_users_by_group,
                'users_other_groups' => $users_other_groups,
            ]);   
        } 
    }      
  
    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',      
                    'gross_monthly_credit_card_sales' => 'numeric',
                    'gross_yearly_sales' => 'numeric', 
                    'loan_amount'        => 'numeric',
                    'brokerage_fee'      => 'numeric',
                 ]);
            } else {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',  
                    'company_id'       => 'required',
                    //'user_id'          => 'required',
                    'gross_monthly_credit_card_sales' => 'numeric',
                    'gross_yearly_sales' => 'numeric', 
                    'loan_amount'        => 'numeric',
                    'brokerage_fee'      => 'numeric',                          
                 ]);                
            }

            $company_id   = 0;
            $user_id      = Auth::user()->id;
            $company_user = CompanyUser::where('user_id','=', $user_id)->first();
            if($company_user) {
                $company_id  = $company_user->company_id;
            }

            $contact = new Contact;

            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                if(!empty($request->input('user_id')) && $request->input('user_id') != "") {
                    $contact->user_id       = $request->input('user_id');
                } else {
                    $contact->user_id       = $user_id;
                }
                $contact->company_id    = $company_id;  
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                //$contact->user_id       = $request->input('user_id');
                $contact->user_id       = $user_id;
                $contact->company_id    = $request->input('company_id');
            } 

            $contact->stage_id      = $request->input('stage_id');
            $contact->full_name     = ucfirst($request->input('firstname')) . ' ' . ucfirst($request->input('lastname'));
            $contact->firstname     = ucfirst($request->input('firstname'));
            $contact->lastname      = ucfirst($request->input('lastname'));
            $contact->email         = $request->input('email');
            $contact->mobile_number = $request->input('mobile_number');
            $contact->work_number   = $request->input('work_number');
            $contact->home_number   = $request->input('home_number');
            $contact->address1      = $request->input('address1');
            $contact->address2      = $request->input('address2');
            $contact->city          = $request->input('city');
            $contact->state         = $request->input('state');
            $contact->zip_code      = $request->input('zip_code');
            $contact->status        = $request->input('status');
            $contact->save();

            if($contact) {

                $contact_business_info = new ContactBusinessInformation;

                if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                    $contact_business_info->user_id       = $user_id;
                    $contact_business_info->company_id    = $company_id;  
                }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                    //$contact_business_info->user_id       = $request->input('user_id');
                    $contact_business_info->user_id       = $user_id;
                    $contact_business_info->company_id    = $request->input('company_id');
                } 

                $contact_business_info->contact_id          = $contact->id;
                $contact_business_info->business_name       = $request->input('business_name');
                $contact_business_info->years_in_business   = $request->input('years_in_business');
                $contact_business_info->legal_entity_of_business  = $request->input('legal_entity_of_business');
                $contact_business_info->accept_credit_card_from_customer    = !empty($request->input('accept_credit_card_from_customer')) ? $request->input('accept_credit_card_from_customer') : 'NA';
                $contact_business_info->gross_monthly_credit_card_sales     = !empty($request->input('gross_monthly_credit_card_sales')) ? $request->input('gross_monthly_credit_card_sales') : 0;
                $contact_business_info->gross_yearly_sales  = !empty($request->input('gross_yearly_sales')) ? $request->input('gross_yearly_sales') : 0;                
                $contact_business_info->filed_bankruptcy    = $request->input('filed_bankruptcy');
                $contact_business_info->bankruptcy_filed    = !empty($request->input('bankruptcy_filed')) ? $request->input('bankruptcy_filed') : '1910-01-01';
                $contact_business_info->credit_score        = !empty($request->input('credit_score')) ? $request->input('credit_score') : 'NA';
                $contact_business_info->save(); 

                $contact_loan_info = new ContactLoanInformation;
                if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                    $contact_loan_info->user_id       = $user_id;
                    $contact_loan_info->company_id    = $company_id;  
                }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                    //$contact_loan_info->user_id       = $request->input('user_id');
                    $contact_loan_info->user_id       = $user_id;
                    $contact_loan_info->company_id    = $request->input('company_id');
                }         
                
                $contact_loan_info->contact_id    = $contact->id;
                $contact_loan_info->loan_amount   = !empty($request->input('loan_amount')) ? $request->input('loan_amount') : 0;
                $contact_loan_info->save();

                $contact_broker_info = new ContactBrokerInformation;
                if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                    $contact_broker_info->user_id       = $user_id;
                    $contact_broker_info->company_id    = $company_id;  
                }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                    //$contact_broker_info->user_id       = $request->input('user_id');
                    $contact_broker_info->user_id       = $user_id;
                    $contact_broker_info->company_id    = $request->input('company_id');
                }         
                
                $contact_broker_info->contact_id    = $contact->id;  
                $contact_broker_info->brokerage_fee = !empty($request->input('brokerage_fee')) ? $request->input('brokerage_fee') : 0;   
                $contact_broker_info->save(); 

                /* assigned contact to company user */
                $assigned_users = $request->input('company_assigned_users');     
                if(isset($assigned_users) && !empty($assigned_users)) {

                    foreach($assigned_users as $a_user) {
                        $uid        = $a_user;
                        $company_id = 0;
                        $contact_id = $contact->id;
                        $c_user     = CompanyUser::where('user_id', '=', $uid)->first();

                        if($c_user) {
                            $company_id = $c_user->company_id;
                        }

                        $contact_assigned_user = new ContactAssignedUser;
                        $contact_assigned_user->contact_id = $contact_id;
                        $contact_assigned_user->company_id  = $company_id;
                        $contact_assigned_user->user_id     = $uid;
                        $contact_assigned_user->save();
                    }

                }
                /* assigned contact to company user - end */

            }

            if($contact) {
                Session::flash('message', 'You have successfully add contact');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');
            } else {
                Session::flash('message', 'Unable to add new contact');
                Session::flash('alert_class', 'alert-danger');
                return redirect('contact');
            }

        }else{
            Session::flash('message', 'Unable to add new contact');
            Session::flash('alert_class', 'alert-danger');           
            return redirect()->back();
        }
    }     

    public function edit($id)
    {     
        $id        = Hashids::decode($id)[0]; 
        $stages    = Stage::all();
        $companies = Companies::all();

        $company_users_by_group = array();
        $company_users = CompanyUser::all();

        if($company_users) {
            $inc = 1;
            foreach($company_users as $company_u) {
                if(isset($company_u->company->name)) {
                    $company_users_by_group[$company_u->company->name][$inc]['user_id'] = $company_u->user_id;
                    $company_users_by_group[$company_u->company->name][$inc]['company_id'] = $company_u->company_id;
                    $company_users_by_group[$company_u->company->name][$inc]['name'] = $company_u->user->firstname . " " . $company_u->user->lastname;
                }
            $inc++;
            }
        }   

        $users_other_groups = array();
        $users_all_others = User::where('group_id','!=',2)->get();  

        if($users_all_others) {
            $inc = 1;
            foreach($users_all_others as $g_user) {
                if(isset($g_user->group->name)) {
                    $users_other_groups[$g_user->group->name][$inc]['user_id'] = $g_user->id;
                    $users_other_groups[$g_user->group->name][$inc]['name']    = $g_user->firstname . " " . $g_user->lastname;
                } else {
                    $users_other_groups['others'][$inc]['user_id'] = $g_user->id;
                    $users_other_groups['others'][$inc]['name']    = $g_user->firstname . " " . $g_user->lastname;
                }
                
            $inc++;
            }
        }         

        $existing_contact_assigned_user = ContactAssignedUser::where('contact_id','=', $id)->get();  
        $existing_assigned_user = array();
        if($existing_contact_assigned_user) {
            $existing_assigned_user = $existing_contact_assigned_user->toArray();       
        }


        if(UserHelper::isCompanyUser(Auth::user()->group_id) || UserHelper::isRTRUser(Auth::user()->group_id) ) {
            $contact = Contact::where('id', '=', $id)->first();
            $contact_business_info = ContactBusinessInformation::where('contact_id', '=', $id)->first();
            $contact_loan_info     = ContactLoanInformation::where('contact_id', '=', $id)->first();
            $contact_broker_info   = ContactBrokerInformation::where('contact_id', '=', $id)->first();
            return view('contact.c_edit', [
                'contact' => $contact,
                'stages'  => $stages,
                'companies' => $companies,
                'contact_business_info' => $contact_business_info,
                'contact_loan_info' => $contact_loan_info,
                'contact_broker_info' => $contact_broker_info,
                'company_users_by_group' => $company_users_by_group,
                'existing_assigned_user' => $existing_assigned_user,
                'users_other_groups' => $users_other_groups
            ]);   
        }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
            $contact = Contact::where('id', '=', $id)->first();
            $contact_business_info = ContactBusinessInformation::where('contact_id', '=', $id)->first();
            $contact_loan_info     = ContactLoanInformation::where('contact_id', '=', $id)->first();
            $contact_broker_info   = ContactBrokerInformation::where('contact_id', '=', $id)->first();            
            return view('contact.edit', [
                'contact' => $contact,
                'stages' => $stages,
                'companies' => $companies,
                'contact_business_info' => $contact_business_info,
                'contact_loan_info' => $contact_loan_info,
                'contact_broker_info' => $contact_broker_info,
                'company_users_by_group' => $company_users_by_group,  
                'existing_assigned_user' => $existing_assigned_user,    
                'users_other_groups' => $users_other_groups,         
            ]);   
        }
    }    

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',          
                    'gross_monthly_credit_card_sales' => 'numeric',
                    'gross_yearly_sales' => 'numeric', 
                    'loan_amount'        => 'numeric',
                    'brokerage_fee'      => 'numeric',               
                 ]);
            } else {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',  
                    'company_id'       => 'required',
                    //'user_id'          => 'required',
                    'gross_monthly_credit_card_sales' => 'numeric',
                    'gross_yearly_sales' => 'numeric', 
                    'loan_amount'        => 'numeric',
                    'brokerage_fee'      => 'numeric',              
                 ]);                
            }

            $id       = Hashids::decode($request->input('id'))[0];
            $contact  = Contact::find($id); 
            $user_id  = Auth::user()->id;

            if($contact) {

                if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                    //$contact->user_id       = $request->input('user_id');
                    $contact->user_id       = $user_id;
                    $contact->company_id    = $request->input('company_id');
                } 

                $contact->stage_id      = $request->input('stage_id');
                $contact->full_name     = ucfirst($request->input('firstname')) . ' ' . ucfirst($request->input('lastname'));
                $contact->firstname     = ucfirst($request->input('firstname'));
                $contact->lastname      = ucfirst($request->input('lastname'));
                $contact->email         = $request->input('email');
                $contact->mobile_number = $request->input('mobile_number');
                $contact->work_number   = $request->input('work_number');
                $contact->home_number   = $request->input('home_number');
                $contact->address1      = $request->input('address1');
                $contact->address2      = $request->input('address2');
                $contact->city          = $request->input('city');
                $contact->state         = $request->input('state');
                $contact->zip_code      = $request->input('zip_code');
                $contact->status        = $request->input('status');
                $contact->save();

                if($contact) {
                    $contact_business_info = ContactBusinessInformation::where('contact_id', '=', $id)->first(); 

                    if($contact_business_info) {

                        if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                            $contact_business_info->user_id       = $user_id; //$request->input('user_id');
                            $contact_business_info->company_id    = $request->input('company_id');
                        } 

                        $contact_business_info->contact_id          = $contact->id;
                        $contact_business_info->business_name       = $request->input('business_name');
                        $contact_business_info->years_in_business   = $request->input('years_in_business');
                        $contact_business_info->legal_entity_of_business  = $request->input('legal_entity_of_business');
                        $contact_business_info->accept_credit_card_from_customer    = !empty($request->input('accept_credit_card_from_customer')) ? $request->input('accept_credit_card_from_customer') : 'NA';
                        $contact_business_info->gross_monthly_credit_card_sales     = !empty($request->input('gross_monthly_credit_card_sales')) ? $request->input('gross_monthly_credit_card_sales') : 0;
                        $contact_business_info->gross_yearly_sales  = !empty($request->input('gross_yearly_sales')) ? $request->input('gross_yearly_sales') : 0;
                        $contact_business_info->filed_bankruptcy    = $request->input('filed_bankruptcy');
                        $contact_business_info->bankruptcy_filed    = !empty($request->input('bankruptcy_filed')) ? $request->input('bankruptcy_filed') : '1910-01-01';
                        $contact_business_info->credit_score        = !empty($request->input('credit_score')) ? $request->input('credit_score') : 'NA';
                        $contact_business_info->save(); 
                    }

                    $contact_loan_info = ContactLoanInformation::where('contact_id', '=', $id)->first(); 
                    if($contact_loan_info) {
                        if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                            $contact_loan_info->user_id       = $user_id; //$request->input('user_id');
                            $contact_loan_info->company_id    = $request->input('company_id');
                        }         
                        
                        $contact_loan_info->contact_id    = $contact->id;
                        $contact_loan_info->loan_amount   = !empty($request->input('loan_amount')) ? $request->input('loan_amount') : 0;
                        $contact_loan_info->save();
                    }

                    $contact_broker_info = ContactBrokerInformation::where('contact_id', '=', $id)->first(); 
                    if($contact_broker_info) {
                        if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                            $contact_broker_info->user_id       = $user_id; //$request->input('user_id');
                            $contact_broker_info->company_id    = $request->input('company_id');
                        }         
                        
                        $contact_broker_info->contact_id    = $contact->id;  
                        $contact_broker_info->brokerage_fee = !empty($request->input('brokerage_fee')) ? $request->input('brokerage_fee') : 0;   
                        $contact_broker_info->save(); 
                    }

                    /* assigned contact to company user */
                    $delete_previous_assigned_user = ContactAssignedUser::where('contact_id', $contact->id)->delete();
                    $assigned_users = $request->input('company_assigned_users');     
                    if(isset($assigned_users) && !empty($assigned_users)) {

                        foreach($assigned_users as $a_user) {
                            $uid        = $a_user;
                            $company_id = 0;
                            $contact_id = $contact->id;
                            $c_user     = CompanyUser::where('user_id', '=', $uid)->first();

                            if($c_user) {
                                $company_id = $c_user->company_id;
                            }

                            $contact_assigned_user = new ContactAssignedUser;
                            $contact_assigned_user->contact_id  = $contact_id;
                            $contact_assigned_user->company_id  = $company_id;
                            $contact_assigned_user->user_id     = $uid;
                            $contact_assigned_user->save();
                        }

                    }
                    /* assigned contact to company user - end */                    

                }

                Session::flash('message', 'Contact has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');                
            } 

        }

        Session::flash('message', 'Unable to update contact');
        Session::flash('alert_class', 'alert-danger');
        return redirect('contact');        
    }

    public function update_status(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'stage_id' => 'required', 
                'status'   => 'required'
            ]);  

            $id      = Hashids::decode($request->input('id'))[0];
            $contact = Contact::find($id); 

            if($contact) {

                $contact->stage_id = $request->input('stage_id');
                $contact->status  = $request->input('status');
                $contact->save();           

                Session::flash('message', 'Contact Status has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');    

            }       

            Session::flash('message', 'Unable to update contact status');
            Session::flash('alert_class', 'alert-danger');
            return redirect('contact');  

        }
    }      

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $c = Contact::find($id);

            if($c) {   
                $c->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');
            }
        }
    }    

    public function ajax_load_company_users(Request $request)
    {
        $c_user_id = 0;
        $company_users = CompanyUser::where('company_id', '=', $request->input('company_id'))->get();

        $c_user_id = $request->input('c_user_id');
        if(!empty($c_user_id)) {
            $c_user_id = $request->input('c_user_id');
            $c_user_id = Hashids::decode($c_user_id)[0];
        }

        return view('contact.ajax_load_company_users_dropdown',[
            'company_users' => $company_users,
            'c_user_id'     => $c_user_id
        ]);
    } 

    public function ajax_load_stage_status(Request $request)
    {
        $workflow = Workflow::where('stage_id', '=', $request->input('stage_id'))->get();
        $status = $request->input('status');
        return view('workflow.ajax_load_stage_status_dropdown',[
            'workflow' => $workflow,
            'status' => $status
        ]);
    }   

    public function ajax_load_update_status(Request $request)
    {
        $id = $request->input('id');
        $contact = Contact::where('id', '=', $id)->first();

        if($contact) {
            $workflow = Workflow::where('stage_id', '=', $contact->stage_id)->get();
            $status   = $contact->status;
            $stages    = Stage::all();

            return view('contact.ajax_load_update_status',[
                'contact' => $contact,
                'workflow' => $workflow,
                'status' => $status,
                'stages' => $stages
            ]);            
        }
    }    

    public function search_mail_records(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  
        $user_id = Auth::user()->id;
        if($search_by != '' && $search_field != '') {
            $mail_messaging_query = MailMessaging::query();

            if($search_by != '' && $search_field != '') {

                if( $search_by == 'all' ){
                    $mail_messaging_query = $mail_messaging_query->where('mail_messaging.subject', 'like', '%' . $search_field . '%')->orWhere('mail_messaging.content', 'like', '%' . $search_field . '%');
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $mail_messaging_query = $mail_messaging_query->where('user_id', '=', Auth::user()->id);
                    }                      
                }elseif( $search_by == 'campaign_name' ){
                    $mail_messaging_query = $mail_messaging_query->where('mail_messaging.subject', 'like', '%' . $search_field . '%');
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $mail_messaging_query = $mail_messaging_query->where('user_id', '=', Auth::user()->id);
                    } 
                }else{
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {                
                        $mail_messaging = MailMessaging::where('user_id','=', $user_id)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(15); 
                    }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                        $mail_messaging = MailMessaging::orderBy('created_at', 'desc')->paginate(15);  
                    }
                }

                $mail_messaging = $mail_messaging_query = $mail_messaging_query->orderBy('created_at', 'desc')->paginate(15);
            }            
        } else {
            
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {                
                $mail_messaging = MailMessaging::where('user_id','=', $user_id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(15); 
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $mail_messaging = MailMessaging::orderBy('created_at', 'desc')->paginate(15);  
            }            
        }

        $stages    = Stage::all();
        $event_types = EventType::all();
        $call_log_activity_history = ContactCallTracker::all();
        $event_types   = EventType::all();

        $emailTemplates = EmailTemplate::where('user_id', '=', $user_id)->get();
        if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
            $contacts = Contact::where('user_id','=', $user_id)->get();
        }else{
            $contacts = Contact::all();
        }
        

        return view('contact.search_mail_records',[
            'mail_messaging' => $mail_messaging,
            'search_field' => $search_field
        ]); 
    } 

    public function update_legal_scrub(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $contact_id  = Hashids::decode($request->input('contact_id'))[0];

            /*$contact = Contact::find($contact_id); 
            $contact->legal_scrub = $request->input('legal_scrub');
            $contact->save();*/

            $contact_note_legal_scrub = ContactNote::where('contact_id','=',$contact_id)->first();
            if(!empty($contact_note_legal_scrub)) {
                $contact_note_legal_scrub->legal_scrub = $request->input('legal_scrub');
                $contact_note_legal_scrub->save();    
            } else {
                $contact_note_legal_scrub = new ContactNote; 
                $contact_note_legal_scrub->contact_id     = $contact_id;
                $contact_note_legal_scrub->note_type_id   = 1;
                $contact_note_legal_scrub->note_title     = 'legal_scrub';
                $contact_note_legal_scrub->note_content   = 'legal_scrub';
                $contact_note_legal_scrub->notify_user_id = 0;
                $contact_note_legal_scrub->legal_scrub = $request->input('legal_scrub');
                $contact_note_legal_scrub->save();                    
            }

            Session::flash('message', 'You have successfully update legal scrub');
            Session::flash('alert_class', 'alert-success');
        }else{
            Session::flash('message', 'Cannot find record');
            Session::flash('alert_class', 'alert-danger');  
        }

        return redirect()->back();    
    }   
}
