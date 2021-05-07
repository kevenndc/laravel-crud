<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
}
