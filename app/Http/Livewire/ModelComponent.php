<?php

namespace App\Http\Livewire;

use App\Helpers\DI;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ModelComponent extends Component
{
    /** @var Model */
    public $model;

    protected $listeners = [
        "refresh" => '$refresh',
        "emittedData",
        "delete",
    ];

    public function mount($params = null, $defaults = null)
    {
        if (! $this->model) {
            $this->model = DI::get(static::MODEL);
        }

        if ($params) {
            $this->model = $this->model::where(
                array_map(fn ($key, $val) => [$key, $val], array_keys($params), array_values($params))
            )->first();
        }

        if ($defaults) {
            $this->model->fill($defaults);
        }
    }

    public function emittedData($data)
    {
        $this->model->fill($data);
    }

    public function edit($modalView)
    {
        $this->emit("openModal", $modalView, [
            "id" => $this->model->id,
        ]);
    }

    public function validateAndSave()
    {
        $this->validate();
        $this->save();
    }

    public function save()
    {
        $this->model->save();
        $this->emit("refresh");
    }

    public function confirmAndDelete()
    {
        $this->emit("openModal", "components.modal.confirm-delete", [
            "src" => static::class,
            "model" => $this->model::class,
            "id" => $this->model->id,
        ]);
    }

    public function delete($id = null)
    {
        if ($id !== null && $id !== $this->model->id) return;

        $this->model->delete();
        $this->emitUp("refresh");
    }
}
