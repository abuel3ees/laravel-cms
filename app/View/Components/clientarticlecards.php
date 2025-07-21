<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class clientarticlecards extends Component
{
    public $article;
    /**
     * Create a new component instance.
     */
    public function __construct($article)
    {   
        $this->article = $article;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.clientarticlecards');
    }
}
