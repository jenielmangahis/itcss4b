<?php
use App\User;

namespace App\Helpers;

class UserHelper
{
      const ADMIN_USER   = 1;
      const COMPANY_USER = 2;

      public static function checkUserRole($group_id = null,$module = null) {

            $with_permission = TRUE;

            $roles['admin_user'] = array(
                  'dashboard',
                  'companies',
                  'company_users',
                  'users',
                  'contacts',
                  'email_templates',
                  'reports',
                  'settings',
                  'groups',
            );

            $roles['company_user'] = array(
                  'dashboard',
                  'users',
                  'contacts',
                  'email_templates'
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

      public static function isCompanyUser() {

      }

      public static function isAdminUser() {

      }
}
?>