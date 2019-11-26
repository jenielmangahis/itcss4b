<?php
namespace App\Helpers;

use App\User;
use App\Contact;
use App\ContactTask;
use App\ContactHistory;

use Illuminate\Support\Facades\DB;

class UserHelper
{
      const ADMIN_USER   = 1;
      const COMPANY_USER = 2;
      const CUSTOMER_USER = 3;
      const USER_ACTIVE    = 0;
      const USER_SUSPENDED = 1;

      public static function checkUserRole($group_id = null,$module = null) 
      {
            $with_permission = TRUE;

            $roles['admin_user'] = array(
                  'dashboard',
                  'companies',
                  'company_users',
                  'users',
                  'contacts',
                  'contact_datasource',
                  'lenders',
                  'contact_campaigns',
                  'workflow',
                  'email_templates',
                  'reports',
                  'settings',
                  'groups',
                  'mail_messaging',
                  'contact_docs'
            );

            $roles['company_user'] = array(
                  'dashboard',
                  'users',
                  'contacts',
                  'lenders',
                  'email_templates',
                  'mail_messaging',
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
            }

            return $with_permission;
      }

      public static function isCompanyUser($group_id = null) 
      {
            $return = FALSE;
            if($group_id == self::COMPANY_USER) {
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

            if(!$contacts->isEmpty()) {
                  foreach($contacts as $contact) {
                        $contact_id = $contact['id'];
                        $contact_history = ContactHistory::where('contact_id','=', $contact_id)
                                                ->latest('created_at')
                                                ->first();

                        if($contact_history) {
                              
                              $last_activity_date = $contact_history->created_at;

                              if(strtotime($last_activity_date) < strtotime('-30 days')) {
                                    $return['idle_data'][] = $contact_history->toArray();
                                    $count_idle++;
                              }                              
                        }
                  }
            }

            $return['total_idle'] = $count_idle; 

            return $return;
      }
}
?>