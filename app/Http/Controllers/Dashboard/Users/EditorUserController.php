<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Traits\UserIndexSortableColumns;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EditorUserController extends Controller
{
    use UserIndexSortableColumns;

    public function index()
    {
        $builder = User::with('role')->where('role_id', '=', 2);
        $users = $this->fetchUsers($builder);

        return view('users.index')->with('users', $users);
    }
}
