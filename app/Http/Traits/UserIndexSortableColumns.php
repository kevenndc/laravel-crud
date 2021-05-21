<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserIndexSortableColumns
{
    protected $columns = [
        'name',
        'posts_count',
        'created_at'
    ];

    public function fetchUsers(Builder $builder)
    {
        return $this->sortColumns($builder)->paginate(10)->withQueryString();
    }

    public function sortColumns(Builder $builder)
    {
        $params = $this->fetchParams();
        if ($params['column'] === 'posts_count') {
            $builder->withCount('posts');
        }
        return $builder->orderBy($params['column'], $params['order']);
    }

    private function fetchParams()
    {
        $column = in_array(request()->get('orderby'), $this->columns) ? request()->get('orderby') : 'created_at';
        $order = in_array(request()->get('order'), ['asc', 'desc']) ? request()->get('order') : 'desc';

        return compact(['column', 'order']);
    }
}
