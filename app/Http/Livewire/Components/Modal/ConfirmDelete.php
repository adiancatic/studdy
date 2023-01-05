<?php

namespace App\Http\Livewire\Components\Modal;

use App\Helpers\DI;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Component;

class ConfirmDelete extends Component
{
    /** @var Model */
    public $model;
    public $src;

    public function mount($params)
    {
        if (! $params["model"]) return;
        if (! $params["id"]) return;
        if (! $params["src"]) return;

        $this->model = DI::get($params["model"]);
        $this->model = $this->model::find($params["id"]);

        $src = $params["src"];
        $src = str_replace("App\\Http\\Livewire\\", "", $src);
        $src = explode("\\", $src);
        $src = array_map(fn ($str) => Str::kebab($str), $src);
        $src = implode(".", $src);
        $this->src = $src;
    }

    public function delete()
    {
        $this->emitTo($this->src, "delete", $this->model->id);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function render()
    {
        return view('livewire.components.modal.confirm-delete');
    }
}
