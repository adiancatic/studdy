<?php

namespace App\View\Components;

use App\View\Composers\AbstractComposer;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    protected $for;
    public $segments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for)
    {
        $this->for = $for;

        $segment = last(Request::segments());

        /** @var AbstractComposer $class */
        $class = new $for;
        $segments = $class::stackTrace($segment);
        $this->setSegments($segments);
    }

    public function getSegments()
    {
        return $this->segments;
    }

    public function setSegments($segments)
    {
        $this->segments = $segments;
        return $this;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
