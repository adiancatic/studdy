<?php

namespace App\View\Components\Dropdown;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public string $align;
    public string $btnGroup;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($align, $btnGroup)
    {
        $this->align = $align;
        $this->btnGroup = $btnGroup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdown.index');
    }
}
