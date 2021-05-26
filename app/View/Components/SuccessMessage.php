<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SuccessMessage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View;
     */
    public function render()
    {
        return view('components.success-message');
    }
}
