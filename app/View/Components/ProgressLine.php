<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProgressLine extends Component
{
    public $actual;
    public $max;
    public $tooltip;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($actual, $max, $tooltip = null)
    {
        $this->actual = $actual;
        $this->max = $max;
        $this->tooltip = $tooltip;
    }

    public function percentage()
    {
        return $this->actual / $this->max * 100;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.progress-line');
    }
}
