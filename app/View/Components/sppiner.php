<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sppiner extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $size;
     public $color;

    public function __construct($size = 'lg', $color = 'blue')
    {
        $this->size = $size;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sppiner');
    }
}
