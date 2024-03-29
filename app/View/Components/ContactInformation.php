<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContactInformation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $contactInfo;
    public $user;
    public function __construct($contactInfo, $user)
    {
        $this->contactInfo=$contactInfo;
        $this->user=$user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.contact-information');
    }
}
