<?php

namespace App\Http\Livewire\Views\Notebooks;

use App\Helpers\BreadcrumbTrait;

class Note extends \App\Http\Livewire\Views\AbstractView
{
    use BreadcrumbTrait;

    public $notebookId;
    /** @var \App\Models\Note */
    public $note;

    public function breadcrumbConf()
    {
        return [
            "item" => "note",
            "modelClass" => \App\Models\Note::class,
            "parentClass" => Notebook::class,
        ];
    }

    public function mount($notebookId, $noteId)
    {
        $this->notebookId = $notebookId;

        $this->note = \App\Models\Note::find($noteId);
    }

    public function render()
    {
        return view('livewire.views.notebooks.note');
    }
}
