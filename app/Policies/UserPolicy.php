<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 是否管理员
     *
     * @param $user
     * @return bool
     */
    public function admin($user, $class)
    {
        foreach (config('site.administrator') as $admin) {
            if ($admin  == $user['name']) {
                return true;
            }
        }
        return false;
    }
}
