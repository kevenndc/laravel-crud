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

    public function fetchPosts(Builder $builder)
    {
        if (Gate::denies('see-others-posts')) {
            $builder->where('user_id', Auth::user()->id);
        }
        return $this->sortColumns($builder)->paginate(10)->withQueryString();
    }

    public function sortColumns(Builder $builder)
    {
        $params = $this->fetchParams();
        return $builder->orderBy($params['column'], $params['order']);
    }

    private function fetchParams() {
        $column = in_array(request()->get('orderby'), $this->columns) ? request()->get('orderby') : 'created_at';
        $order = in_array(request()->get('order'), ['asc', 'desc']) ? request()->get('order') : 'desc';

        return compact(['column', 'order']);
    }
}
