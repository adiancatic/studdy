<?php

namespace App\View\Components\EmptyState;

use Illuminate\View\Component;

class Basic extends Component
{
    public string $title;
    public string $subtitle;
    public string $icon;
    public string $description;
    public array $ctas;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $subtitle = "", $icon = "", $description = "", $ctas = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->icon = $icon;
        $this->description = $description;
        $this->ctas = $ctas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.empty-state.basic');
    }
}
