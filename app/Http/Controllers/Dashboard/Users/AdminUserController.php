<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Traits\UserIndexSortableColumns;
use App\Models\User;

class AdminUserController extends Controller
{
    use UserIndexSortableColumns;

    public function index()
    {
        $builder = User::with('role')->where('role_id', '=', 1);
        $users = $this->fetchUsers($builder);

        return view('users.index')->with('users', $users);
    }
}
