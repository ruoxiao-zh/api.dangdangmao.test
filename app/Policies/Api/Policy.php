<?php

namespace App\Policies\Api;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(AdminUser $adminUser)
    {
        //if ($adminUser->isAdmin()) {
            return true;
        //}
    }
}
