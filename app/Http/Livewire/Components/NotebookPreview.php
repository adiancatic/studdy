<?php

namespace App\Http\Livewire\Components;

use App\Models\Note;
use App\Models\Notebook;
use Livewire\Component;

class NotebookPreview extends Component
{
    public $notebooks;
    public $selectedNotebook;
    public $subjectId;

    protected $listeners = [
        "selectNotebook",
        "deleteNotebook",
        "refresh",
        "confirmAndDeleteNotebook",
        "delete" => "deleteNotebook",
    ];

    public function mount($subject = null)
    {
        if ($subject) {
            $this->subjectId = $subject;
            $this->notebooks = Notebook::where("subject_id", $subject)->get();
        } else {
            $this->notebooks = Notebook::all();
        }

        if (! $this->notebooks->isEmpty()) {
            $this->selectedNotebook = $this->notebooks->first();
        }
    }

    public function refresh()
    {
        $this->mount($this->subjectId);
    }

    public function selectNotebook($notebookId)
    {
        $this->selectedNotebook = $this->notebooks->find($notebookId);
    }

    public function addNote()
    {
        $newNote = Note::create([
            "notebook_id" => $this->selectedNotebook->id,
        ]);

        $this->selectedNotebook->notes->push($newNote);
    }

    public function confirmAndDeleteNotebook($id)
    {
        $this->emit("openModal", "components.modal.confirm-delete", [
            "src" => static::class,
            "model" => Notebook::class,
            "id" => $id,
        ]);
    }

    public function deleteNotebook($id)
    {
        $notebook = $this->notebooks->find($id);
        if (! $notebook) return;

        $notebook->delete();
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.components.notebook-preview');
    }
}
