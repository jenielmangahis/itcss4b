<?php
namespace App\Helpers;

use App\User;
use App\Contact;
use App\ContactTask;
use App\ContactHistory;
use App\ContactBusinessInformation;

use Session;

use Illuminate\Support\Facades\DB;

class UserHelper
{
      const ADMIN_USER     = 1;
      const COMPANY_USER   = 2;
      const CUSTOMER_USER  = 3;
      const RTR_USER       = 4;

      const USER_ACTIVE    = 0;
      const USER_SUSPENDED = 1;

      const ACCESS_TYPE_VIEW_ONLY = 1; //View Only
      CONST ACCESS_TYPE_ALL       = 2; //ACCESS ALL (View, Edit & Delete)

      public static function getRoles() 
      {
            $roles['admin_user'] = array(
                  'dashboard',
                  'companies',
                  'company_users',
                  'user_management',
                        'users',
                        'mca_funders',
                        'groups',
                  'contacts',
                        'history',
                        'advances',
                        'calls',
                        'emails',
                        'notes',
                        'emarketing',
                        'docs',
                        'events',
                        'others',
                              'tasks',
                              'bank_account',
                              'credit_card',
                              'legal_scrub',
                  'contact_datasource',
                  'lenders',
                  'contact_campaigns',
                  'workflow',
                  'email_templates',
                  'reports',
                  'settings',
                  'mail_messaging',
                  'contact_docs',
                  'notifications',
                  'reports',
                        'users_log',
                        'audit_logs',
                        'merchant_logs',
            );

            //this is also the mca funders/user also
            $roles['company_user'] = array(
                  'dashboard',
                  'users',
                  'contacts',
                        'history',
                        'advances',
                        'notes',
                        'events',
                  'contact_docs'
            );

            $roles['customer_user'] = array(
                  'dashboard',
                  'contact_docs',
                  'contact_notes',
                  'contact_task',
                  'contacts',
                  'contact_advance',
                  'mail_messaging'
            );

            $roles['rtr_user'] = array(
                  'dashboard',
                  'companies',
                  'company_users',
                  'user_management',
                        'users',
                        'mca_funders',
                        'groups',
                  'contacts',
                        'history',
                        'advances',
                        'calls',
                        'emails',
                        'notes',
                        'emarketing',
                        'docs',
                        'events',
                        'others',
                              'tasks',
                              'bank_account',
                              'credit_card',
                              'legal_scrub',
                  'contact_datasource',
                  'lenders',
                  'contact_campaigns',
                  'workflow',
                  'email_templates',
                  'reports',
                  'settings',
                  'mail_messaging',
                  'contact_docs',
                  'notifications'
            );           
            
            return $roles; 
      }

      public static function getModulePermissions()
      {
            /*
             * Note: Default to all access (view, edit, create & Delete)
            */

            $permission['admin_user'] = array(
                  'all_access' => TRUE
            );

            $permission['company_user'] = array(
                  'all_access' => FALSE
            );

            $permission['customer_user'] = array(
                  'all_access' => FALSE
            );

            $permission['rtr_user'] = array(
                  'all_access' => TRUE
            );

            return $permission;
      }      

      public static function checkUserRole($group_id = null,$module = null) 
      {
            $with_permission = TRUE;

            $roles = self::getRoles();

            if($group_id == self::ADMIN_USER) {
                  if (!in_array($module, $roles['admin_user'], TRUE)) { 
                        $with_permission = FALSE;
                  } 
            }elseif($group_id == self::COMPANY_USER) {
                  if (!in_array($module, $roles['company_user'], TRUE)) { 
                        $with_permission = FALSE;          
                  } 
            }elseif($group_id == self::CUSTOMER_USER) {
                  if (!in_array($module, $roles['customer_user'], TRUE)) { 
                        $with_permission = FALSE;          
                  }
            }elseif($group_id == self::RTR_USER) {
                  if (!in_array($module, $roles['rtr_user'], TRUE)) { 
                        $with_permission = FALSE;          
                  }
            }

            return $with_permission;
      }

      public static function checkUserRolePermission($group_id = null, $module = null, $function = null, $redirect = false) {
            $with_permission = TRUE;
            $with_access     = FALSE;
            $roles           = self::getRoles();

            if($group_id == self::ADMIN_USER) {
                  if (!in_array($module, $roles['admin_user'], TRUE)) { 
                        $with_permission = FALSE;
                  } 
            }elseif($group_id == self::COMPANY_USER) {
                  if (!in_array($module, $roles['company_user'], TRUE)) { 
                        $with_permission = FALSE;          
                  } 
            }elseif($group_id == self::CUSTOMER_USER) {
                  if (!in_array($module, $roles['customer_user'], TRUE)) { 
                        $with_permission = FALSE;          
                  }
            }elseif($group_id == self::RTR_USER) {
                  if (!in_array($module, $roles['rtr_user'], TRUE)) { 
                        $with_permission = FALSE;          
                  }
            }

            if($with_permission == TRUE) {
                  $function_permission = self::getModulePermissions();

                  if($group_id == self::ADMIN_USER) {
                        if (!in_array($module, $function_permission['admin_user'], TRUE)) { 
                              $all_access = $function_permission['admin_user']['all_access'];   
                              if($all_access) {
                                    $with_access = TRUE;
                              }
                        } 
                  }elseif($group_id == self::COMPANY_USER) {
                        if (!in_array($module, $function_permission['company_user'], TRUE)) { 
                              $all_access = $function_permission['company_user']['all_access'];   
                              if($all_access) {
                                    $with_access = TRUE;
                              }
                        } 
                  }elseif($group_id == self::CUSTOMER_USER) {
                        if (!in_array($module, $function_permission['customer_user'], TRUE)) {  
                              $all_access = $function_permission['customer_user']['all_access'];   
                              if($all_access) {
                                    $with_access = TRUE;
                              }
                        }
                  }elseif($group_id == self::RTR_USER) {
                        if (!in_array($module, $function_permission['rtr_user'], TRUE)) {   
                              $all_access = $function_permission['rtr_user']['all_access'];   
                              if($all_access) {
                                    $with_access = TRUE;
                              }     
                        }
                  }                  
            }      

            if($redirect && !$with_access) {
                  Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                  Session::flash('alert_class', 'alert-danger');                               
            } else {
                  return $with_access;
            }

      }

      public static function isCompanyUser($group_id = null) 
      {
            $return = FALSE;
            if($group_id == self::COMPANY_USER) {
                  $return = TRUE;
            }

            return $return;
      }

      public static function isRTRUser($group_id = null) 
      {
            $return = FALSE;
            if($group_id == self::RTR_USER) {
                  $return = TRUE;
            }

            return $return;
      }

      public static function isAdminUser($group_id = null) 
      {
            $return = FALSE;
            if($group_id == self::ADMIN_USER) {
                  $return = TRUE;
            }

            return $return;
      }   

      public static function customerGroupId()
      {
            return 3;
      }

      public static function clientLoginURL()
      {
            $url = url("/") . "/login";
            return $url;
      }

      public static function resetPasswordURL()
      {
            $url = url("/") . "/reset_password";
            return $url;
      }

      public static function generateRandomString($length = 10, $user_id) 
      {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString . $user_id;
      }

      public static function getIdleContacts()
      {
            $return     = array();
            $contacts   = Contact::select('id')->get();

            $count_idle = 0;
            $idle_data  = array();

            if(!$contacts->isEmpty()) {
                  foreach($contacts as $contact) {
                        $contact_id = $contact['id'];
                        $contact_history = ContactHistory::where('contact_id','=', $contact_id)
                                                ->latest('created_at')
                                                ->first();

                        if($contact_history) {
                              
                              $last_activity_date = $contact_history->created_at;

                              if(strtotime($last_activity_date) < strtotime('-15 days')) {
                                    $idle_data[] = $contact_history->toArray();
                                    //$return['idle_data'][] = $contact_history->toArray();
                                    $count_idle++;
                              }                              
                        }
                  }
            }

            $return['idle_data']  = $idle_data;
            $return['total_idle'] = $count_idle; 

            return $return;
      }

      public static function getTotalUserContactEntry($user_id)
      {
            $total = 0;

            $total_entry = Contact::where('user_id','=', $user_id)
                  ->count();

            if($total_entry > 0) {
                  $total = $total_entry;
            }

            return $total;
      }

      public static function getTodayTotalUserContactEntry($user_id)
      {
            $total = 0;

            $total_entry = Contact::where('user_id','=', $user_id)
                  ->whereDay('created_at', '=', date('d'))
                  ->count();

            if($total_entry > 0) {
                  $total = $total_entry;
            }

            return $total;            
      }

      public static function getTotalUserContactEntryByDate($user_id, $date)
      {
            $total = 0;

            $total_entry = Contact::where('user_id','=', $user_id)
                  ->whereDate('created_at', '=', date('Y-m-d', strtotime($date)))
                  ->count();

            if($total_entry > 0) {
                  $total = $total_entry;
            }

            return $total;            
      }      

      public static function getCompaniesBankrupt()
      {
            $bankruptcy = ContactBusinessInformation::leftJoin('contacts', 'contact_business_informations.contact_id', 'contacts.id')->where('filed_bankruptcy','=','Yes')->where('contacts.is_completed', '!=', 1)->where('bankruptcy_filed','<=',now()->subMonth(2))->get();

            return $bankruptcy;
      }

      public static function getContactsSettled()
      {
            $settled  = Contact::where('is_settled','=','Yes')->where('is_completed','<>',1)->where('date_settled','<=',now()->subMonth(1))->get();
            return $settled;
      }
}
?>