<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\ModelComponent;
use App\Models\Note;

class ListItem extends ModelComponent
{
    const MODEL = Note::class;

    public $index;
    public $isSortable = false;

    public function update($data)
    {
        $this->model->fill($data);
        $this->save();
    }

    public function render()
    {
        return view('livewire.components.list-item');
    }
}
