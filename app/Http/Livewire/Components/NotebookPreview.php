<?php

namespace App\Http\Livewire\Components;

use App\Models\Notebook;
use Livewire\Component;

class NotebookPreview extends Component
{
    public $notebooks;
    public $selectedNotebook;

    protected $listeners = [
        "selectNotebook",
    ];

    public function mount($subject = null)
    {
        $this->notebooks = $subject
            ? Notebook::where("subject_id", $subject)->get()
            : Notebook::all();

        if (! $this->notebooks->isEmpty()) {
            $this->selectedNotebook = $this->notebooks[0];
        }
    }

    public function selectNotebook($notebookId)
    {
        $this->selectedNotebook = $this->notebooks->find($notebookId);
    }

    public function render()
    {
        return view('livewire.components.notebook-preview');
    }
}
