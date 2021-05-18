<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PasswordInput extends Component
{
    /**
     * The input field name.
     *
     * @var $name
     */
    public $name;

    /**
     * The input field id.
     *
     * @var $id
     */
    public $id;

    /**
     * Controls if the input is enabled.
     *
     * @var $locked
     */
    public $locked;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $id, ?string $value = null, string $locked = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->locked = $locked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.password-input');
    }
}
