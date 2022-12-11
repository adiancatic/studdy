<?php

namespace App\Http\Livewire\Views\Notebooks;

use App\Helpers\BreadcrumbTrait;
use App\Models\Note;

class Notebook extends \App\Http\Livewire\Views\AbstractView
{
    use BreadcrumbTrait;

    /** @var \App\Models\Notebook */
    public $notebook;
    /** @var Note[] */
    public $notes;

    protected $listeners = [
        "deleteItem",
        "updateItem",
        "refresh" => '$refresh',
    ];

    public function breadcrumbConf()
    {
        return [
            "item" => "notebook",
            "modelClass" => \App\Models\Notebook::class,
            "parentClass" => NotebookList::class,
        ];
    }

    public function mount($notebookId)
    {
        $this->notebook = \App\Models\Notebook::find($notebookId);
        $this->notes = $this->notebook->notes;
    }

    public function addNote($notebookId)
    {
        $newNote = Note::create([
            "title" => "New note",
            "content" => "...",
            "notebook_id" => $notebookId,
        ]);

        $this->notes->push($newNote);
    }

    public function deleteItem(Note $note)
    {
        $this->notes = $this->notes->diff([$note]);
        $note->delete();
    }

    public function updateItem(Note $note, $data)
    {
        $note->fill($data)->save();
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.views.notebooks.notebook');
    }
}
