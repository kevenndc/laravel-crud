<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SideMenuItem extends Component
{
    /**
     * The menu item title.
     *
     * @var string
     */
    public $title;

    /**
     * The route name.
     *
     * @var string
     */
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $route)
    {
        $this->title = $title;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-side-menu-item');
    }
}
