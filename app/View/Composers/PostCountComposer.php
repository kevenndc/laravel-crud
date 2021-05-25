<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostCountComposer
{
    /**
     * Composes a view with counts of each post status.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $builder = Post::withTrashed();

        if (Gate::denies('see-others-posts')) {
            $builder->where('user_id', Auth::user()->id);
        }

        $counts = $this->getCounts($builder);

        $view->with('counts', $counts);
    }

    private function getCounts(Builder $builder)
    {
        $counts = $builder->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status');

        return $counts->merge(['all' => $counts->sum()])->toArray();
    }
}
