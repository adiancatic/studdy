<?php

namespace App\Http\Livewire\Components;

use App\Models\Subject;
use Livewire\Component;

class SubjectCard extends Component
{
    /** @var Subject */
    public $subject;

    public function render()
    {
        return view('livewire.components.subject-card');
    }
}
