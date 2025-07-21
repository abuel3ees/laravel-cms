<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class chartcards extends Component
{
    public $title;
    public $chartId;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $chartId)
    {
        $this->title = $title;
        $this->chartId = $chartId;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chartcards');
    }
}
