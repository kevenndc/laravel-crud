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

            $counts = $builder->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status');

            $counts = $counts->merge(['all' => $counts->sum()])->toArray();

            $view->with('counts', $counts);
        });
    }
}
