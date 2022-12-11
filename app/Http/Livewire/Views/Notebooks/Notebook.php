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
        $this->notes = $this->notebook->notes()->orderBy("order")->get();
    }

    public function addNote($notebookId)
    {
        $newNote = Note::create([
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

    public function updateOrder($items)
    {
        $order = collect($items)->pluck("order", "value")->toArray();

        foreach ($this->notes as $note) {
            // dump("before: {$note->order} | after: {$order[$note->id]}");
            $note->order = $order[$note->id];
            $note->save();
        }

        $this->notes = $this->notebook->fresh()->notes()->orderBy("order")->get();
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.views.notebooks.notebook');
    }
}
