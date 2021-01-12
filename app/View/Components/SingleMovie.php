<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SingleMovie extends Component
{
    public $genres;
    public $moviess;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($genres,$moviess)
    {
        $this->genres=$genres;
        $this->moviess=$moviess;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.single-movie');
    }
}
