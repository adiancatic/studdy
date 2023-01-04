<?php

namespace App\Http\Livewire\Views\Subjects\Modal;

use App\Http\Livewire\ModelComponent;
use App\Models\Subject;

class EditSubjectModal extends ModelComponent
{
    protected const MODEL = Subject::class;

    protected $rules = [
        "model.title" => "required",
        "model.icon" => "sometimes",
    ];

    public function validateAndSave()
    {
        parent::validateAndSave();

        $this->dispatchBrowserEvent("closeModal");
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.views.subjects.modal.edit-subject-modal');
    }
}
