<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

trait PostIndexSortableColumns
{
    protected $columns = [
        'title',
        'created_at',
    ];

    /**
     * Fetch all sorted posts that the user is allowed to see.
     * @param Builder $builder
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function fetchPosts(Builder $builder)
    {
        if (Gate::denies('see-others-posts')) {
            $builder->where('user_id', Auth::user()->id);
        }
        return $this->sortPosts($builder)->paginate(10)->withQueryString();
    }

    /**
     * Sort the posts by the column and order given by a query string.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function sortPosts(Builder $builder)
    {
        return $builder->orderBy($this->getColumn(), $this->getOrder());
    }

    private function getColumn() {
        return $this->columns[request()->get('orderby')] ?? 'created_at';
    }

    private function getOrder() {
        $orders = ['asc', 'desc'];
        return $orders[request()->get('order')] ?? 'desc';
    }
}
