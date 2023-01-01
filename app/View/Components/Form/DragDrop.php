<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class DragDrop extends Component
{
    public $model;
    public $icon;
    public $title;
    public $description;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model, $icon = null, $title = null, $description = null, $content = null)
    {
        $this->model = $model;
        $this->icon = $icon;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.drag-drop');
    }
}
