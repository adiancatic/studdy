<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\ModelComponent;
use App\Models\Subject;

class SubjectCard extends ModelComponent
{
    const MODEL = Subject::class;

    public function render()
    {
        return view('livewire.components.subject-card');
    }
}
