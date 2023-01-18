<?php

namespace App\Http\Livewire\Views\Quizzes\Modal;

use App\Http\Livewire\ModelComponent;
use App\Models\Quiz;
use App\Models\QuizLog;

class FinishQuizModal extends ModelComponent
{
    protected const MODEL = Quiz::class;

    public $rating;

    public function validateAndSave()
    {
        QuizLog::create([
            "rating" => $this->rating,
            "quiz_id" => $this->model->id,
        ]);

        $this->dispatchBrowserEvent("closeModal");
        $this->redirect("/quizzes");
    }

    public function render()
    {
        return view('livewire.views.quizzes.modal.finish-quiz-modal');
    }
}
