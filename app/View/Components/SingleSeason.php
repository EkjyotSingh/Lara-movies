<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SingleSeason extends Component
{
    public $season;
    public $id;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($season,$id,$name)
    {
        $this->season=$season;
        $this->id=$id;
        $this->name=$name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.single-season');
    }
}
