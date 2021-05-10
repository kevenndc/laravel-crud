<?php

namespace App\Http\Traits;

trait PostSortableColumns
{
    protected $columns = [
        'title',
        'created_at',
    ];

    public function sortColumns(\Illuminate\Database\Eloquent\Builder $builder)
    {
        $params = $this->fetchParams();
        return $builder->orderBy($params['column'], $params['order']);
    }

    private function fetchParams() {
        $column = in_array(request()->get('orderby'), $this->columns)
            ? request()->get('orderby')
            : 'created_at';
        $order = request()->get('order') ?? 'asc';
        return compact(['column', 'order']);
    }
}
