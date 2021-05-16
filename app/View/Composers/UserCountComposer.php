<?php

namespace App\View\Composers;

use App\Models\Role;
use Illuminate\View\View;

class UserCountComposer
{
    /**
     * Composes a view with counts of each post status.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $counts = Role::withCount('users')
            ->get()
            ->pluck('users_count', 'name');

        $counts = $counts->merge(['all' => $counts->sum()])->toArray();

        $view->with('counts', $counts);
    }
}
