<?php

namespace App\Http\Livewire\Views\Notebooks\Modal;

use App\Http\Livewire\ModelComponent;
use App\Models\Notebook;
use Illuminate\Support\Facades\Auth;

class EditNotebookModal extends ModelComponent
{
    protected const MODEL = Notebook::class;

    protected $rules = [
        "model.subject_id" => "required",
        "model.title" => "required",
        "model.icon" => "sometimes",
    ];

    public function getSubjects()
    {
        return Auth::user()->subjects;
    }

    public function getDefaultSubject()
    {
        return $this->model->subject_id ?: $this->getSubjects()->first()->id;
    }

    public function mount($params = null, $defaults = null)
    {
        parent::mount($params, $defaults);

        $this->model->subject_id = $this->getDefaultSubject();
    }

    public function validateAndSave()
    {
        parent::validateAndSave();

        $this->dispatchBrowserEvent("closeModal");
        $this->emitUp("refresh");
    }

    public function render()
    {
        return view('livewire.views.notebooks.modal.edit-notebook-modal');
    }
}
