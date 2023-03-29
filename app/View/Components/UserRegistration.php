<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserRegistration extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wrapper;
    public $todayDate;
    public function __construct($wrapper, $todayDate)
    {
        $this->wrapper=$wrapper;
        $this->todayDate=$todayDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-registration');
    }
}
