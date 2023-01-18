<?php

namespace App\Http\Livewire\Views\Quizzes\Modal;

use App\Http\Livewire\ModelComponent;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class EditQuizModal extends ModelComponent
{
    protected const MODEL = Quiz::class;

    protected $rules = [
        "model.title" => "required",
        "model.note_id" => "sometimes",
    ];

    public function validateAndSave()
    {
        if ((int) $this->model->note_id === 0) {
            $this->model->note_id = null;
        }

        parent::validateAndSave();

        $this->dispatchBrowserEvent("closeModal");
        $this->emitUp("refresh");
    }

    public function render()
    {
        return view('livewire.views.quizzes.modal.edit-quiz-modal');
    }
}
