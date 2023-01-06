<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\ModelComponent;
use App\Models\Notebook;

class NotebookCard extends ModelComponent
{
    const MODEL = Notebook::class;

    public function render()
    {
        return view('livewire.components.notebook-card');
    }
}
