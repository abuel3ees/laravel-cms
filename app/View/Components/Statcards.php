<?php

namespace App\View\Components;

use Closure;
use Faker\Core\Color;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Statcards extends Component
{
    public $value;
    public $title;
    public $colorClass;
    public function __construct($value, $title, $colorClass = 'text-danger')
    {
        $this->value = $value;
        $this->title = $title;
        $this->colorClass = $colorClass;
    {
        
    }
}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statcards');
    }
}
