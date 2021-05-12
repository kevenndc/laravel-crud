<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.post-counts', function ($view) {
            $builder = Post::query();

            if (Gate::denies('see-others-posts')) {
                $builder->where('user_id', Auth::user()->id);
            }

            $counts = $builder->select([
                DB::raw('id'),
                DB::raw('COUNT(*) as `all`'),
                DB::raw('SUM(CASE WHEN published = 1 THEN 1 ELSE 0 END) AS `published`'),
                DB::raw('SUM(CASE WHEN published = 0 THEN 1 ELSE 0 END) AS `drafts`'),
                DB::raw("SUM(CASE WHEN deleted_at IS NOT NULL OR deleted_at <> '' THEN 1 ELSE 0 END) AS `trashed`"),
            ])
            ->groupBy('id')
            ->get();

            dd($counts);

            $counts = Post::countAllStates();
            $view->with('counts', $counts);
        });
    }
}
