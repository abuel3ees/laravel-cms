<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class mediacard extends Component
{
    public $file;
    /**
     * Create a new component instance.
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mediacard');
    }
}
