<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserProfileImageInput extends Component
{
    /**
     * The name of the input field.
     *
     * @var $name
     */
    public $name;

    /**
     * The user avatar image source.
     *
     * @var $value
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, ?string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-profile-image-input');
    }
}
