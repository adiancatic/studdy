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
    ];

    public function mount($params = null)
    {
        if (! $this->model) {
            $this->model = DI::get(static::MODEL);
        }

        if ($params) {
            $this->model = $this->model::where(
                array_map(fn ($key, $val) => [$key, $val], array_keys($params), array_values($params))
            )->first();
        }
    }

    public function emittedData($data)
    {
        $this->model->fill($data);
    }

    public function validateAndSave()
    {
        $this->validate();
        $this->save();
    }

    public function save()
    {
        $this->model->save();
        $this->emitUp("refresh");
    }

    public function confirmAndDelete()
    {
        $this->emit("openModal", "components.modal.confirm-delete", [
            "model" => $this->model::class,
            "id" => $this->model->id,
        ]);
    }

    public function delete()
    {
        $this->model->delete();
        $this->emitUp("refresh");
    }
}
