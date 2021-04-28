<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SortableTH extends Component
{
    /**
     * The route name that will handle the GET request.
     *
     * @var string
     */
    public $route;

    /**
     * The column which the items should be order by.
     *
     * @var string
     */
    public $column;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $route ,string $column)
    {
        $this->route = $route;
        $this->column = $column;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sortable-th');
    }
}
