<?php

namespace App\Http\Livewire\Components\Modal;

use App\Helpers\DI;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ConfirmDelete extends Component
{
    /** @var Model */
    public $model;

    public function mount($params)
    {
        if (! $params["model"]) return;
        if (! $params["id"]) return;

        $this->model = DI::get($params["model"]);
        $this->model = $this->model::find($params["id"]);
    }

    public function delete()
    {
        $this->model->delete();

        $this->dispatchBrowserEvent("closeModal");
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.components.modal.confirm-delete');
    }
}
