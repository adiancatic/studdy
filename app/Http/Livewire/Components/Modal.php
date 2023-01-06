<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Modal extends Component
{
    public $view;
    public $params;
    public $defaults;

    protected $listeners = [
        "openModal",
    ];

    public function openModal($view, $params = null, $defaults = null)
    {
        $this->view = $view;
        $this->params = $params;
        $this->defaults = $defaults;

        $this->dispatchBrowserEvent("modalRendered");
    }

    public function render()
    {
        return <<<'blade'
            <div class="modal-component">
                @if($view)
                    <div class="modal fade" id="modal" tabindex="-1">
                        <livewire:dynamic-component
                            component="{{ $view }}"
                            :params="$params"
                            :defaults="$defaults"
                            key="{{ uniqid(json_encode($params), true) }}" />
                    </div>
                @endif
            </div>
        blade;
    }
}
