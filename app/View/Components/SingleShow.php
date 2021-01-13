<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SingleShow extends Component
{
    public $showss;
    public $genres;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showss,$genres)
    {
        $this->showss=$showss;
        $this->genres=$genres;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.single-show');
    }
}
