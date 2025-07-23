<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class filteringsystem extends Component
{
    public $users;
    /**
     * Create a new component instance.
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filteringsystem');
    }
}
