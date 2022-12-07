<?php

namespace App\Http\Livewire\Views\Notebooks;

use App\Helpers\BreadcrumbTrait;
use App\Models\Note;

class Notebook extends \App\Http\Livewire\Views\AbstractView
{
    use BreadcrumbTrait;

    public $notebook;
    /** @var \App\Http\Livewire\Views\Notebooks\Note[] */
    public $notes;

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

    public function render()
    {
        return view('livewire.views.notebooks.notebook');
    }
}
