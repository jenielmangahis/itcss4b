<?php
use App\User;

namespace App\Helpers;

class UserHelper
{
      const ADMIN_USER   = 1;
      const COMPANY_USER = 2;
      const USER_ACTIVE    = 0;
      const USER_SUSPENDED = 1;

      public static function checkUserRole($group_id = null,$module = null) {

            $with_permission = TRUE;

            $roles['admin_user'] = array(
                  'dashboard',
                  'companies',
                  'company_users',
                  'users',
                  'contacts',
                  'contact_datasource',
                  'contact_campaigns',
                  'workflow',
                  'email_templates',
                  'reports',
                  'settings',
                  'groups',
                  'mail_messaging'
            );

            $roles['company_user'] = array(
                  'dashboard',
                  'users',
                  'contacts',
                  'email_templates',
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
            }

            return $with_permission;
      }

      public static function isCompanyUser($group_id = null) {
            $return = FALSE;
            if($group_id == self::COMPANY_USER) {
                  $return = TRUE;
            }

            return $return;
      }

      public static function isAdminUser($group_id = null) {
            $return = FALSE;
            if($group_id == self::ADMIN_USER) {
                  $return = TRUE;
            }

            return $return;
      }
   
}
?>