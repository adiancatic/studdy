<?php

namespace App\View\Composers\Notebooks;

use App\Models\Note;
use App\View\Composers\AbstractComposer;
use Illuminate\View\View;

class NotebooksNoteComposer extends AbstractComposer
{
    protected const TITLE = "";
    public const ICON = "";
    public const VIEW = "composers.notebooks.note";

    protected Note $note;

    public function compose(View $view): void
    {
        parent::compose($view);

        $this->setNote($view->getData()["note"]);
    }

    /**
     * @return Note
     */
    public function getNote(): Note
    {
        return $this->note;
    }

    /**
     * @param Note $note
     * @return NotebooksNoteComposer
     */
    public function setNote(Note $note)
    {
        $this->note = $note;
        return $this;
    }
}
