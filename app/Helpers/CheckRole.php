<?php

namespace App\Helpers;

class CheckRole
{
    static function checkRole($auth_user, $user)
    {
        $current_user_roles = $auth_user->getRoleNames()->toArray();
        $user_roles = $user->getRoleNames()->toArray();

        $has_all_roles = !array_diff($user_roles, $current_user_roles);
        if ($has_all_roles) {
            return true;
        } else {
            return false;
        }
    }
}