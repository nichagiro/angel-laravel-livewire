<?php

namespace App\View\Components;

use Illuminate\View\Component;

class notifyComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $msg;
    public $bg;

    public function __construct($msg1, $bg1)
    {
        $this->msg = $msg1;
        $this->bg = $bg1;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notify-component');
    }
}
