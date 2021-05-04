<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleButton extends Component
{
    /**
     * The HTML 'name' attribute of the input field.
     *
     * @var $name
     * @type string
     */
    public $name;

    /**
     * The label of the input field.
     *
     * @var $label
     * @type string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toggle-button');
    }
}
