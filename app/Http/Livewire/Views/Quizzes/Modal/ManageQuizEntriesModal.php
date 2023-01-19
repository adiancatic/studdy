<?php

namespace App\Http\Livewire\Views\Quizzes\Modal;

use App\Http\Livewire\ModelComponent;
use App\Models\Quiz;
use App\Models\QuizEntry;

class ManageQuizEntriesModal extends ModelComponent
{
    protected const MODEL = Quiz::class;

    protected $rules = [
        "model.title" => "required",
        "model.note_id" => "sometimes",
    ];

    /** @var QuizEntry[] */
    public $entries;

    public function mount($params = null, $defaults = null)
    {
        parent::mount($params, $defaults);

        $this->entries = collect($this->model->entries->toArray());
    }

    public function addQuestion()
    {
        $newEntry = new QuizEntry();
        $this->entries->push($newEntry);
    }

    public function deleteQuestion($index)
    {
        $entry = $this->entries->get($index);

        if (! empty($entry["id"])) {
            $model = QuizEntry::find($entry["id"]);
            $model->delete();
        }

        $this->entries->forget($index);
    }

    public function validateAndSave()
    {
        parent::validateAndSave();

        foreach ($this->entries as $entry) {
            if (empty($entry["question"])) continue;

            $model = (! empty($entry["id"]))
                ? QuizEntry::find($entry["id"])
                : new QuizEntry();

            $model->quiz_id = $this->model->id;

            $model
                ->fill($entry)
                ->save();
        }

        $this->dispatchBrowserEvent("closeModal");
        $this->emitUp("refresh");
    }

    public function render()
    {
        return view('livewire.views.quizzes.modal.manage-quiz-entries-modal');
    }
}
