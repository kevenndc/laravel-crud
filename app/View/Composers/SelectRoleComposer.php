<?php

namespace App\View\Composers;

use App\Models\Role;
use Illuminate\View\View;

class SelectRoleComposer
{
    /**
     * Compose a component for selecting a user role.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $roles = Role::select('id', 'name')->get();
        $view->with(compact('roles'));
    }
}
