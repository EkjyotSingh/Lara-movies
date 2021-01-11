<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeriesCast extends Component
{
    public $crew;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($crew)
    {
        $this->crew=$crew;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.series-cast');
    }
}
