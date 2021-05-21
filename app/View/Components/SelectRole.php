<?php

namespace App\View\Components;

use App\Models\Role;
use Illuminate\View\Component;

class SelectRole extends Component
{
    /**
     * The name attribute of the input.
     *
     * @var string
     */
    public $name;

    /**
     * The user current role.
     *
     * @var Role
     */
    public $currentRole;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, Role $currentRole = null)
    {
        $this->name = $name;
        $this->currentRole = $currentRole;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-role');
    }
}
