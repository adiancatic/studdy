<?php

namespace App\View\Composers\Notebooks;

use App\Models\Note;
use App\View\Composers\AbstractItemComposer;

class NotebooksNoteComposer extends AbstractItemComposer
{
    public const MODEL = Note::class;

    protected const TITLE = "Note";
    public const ICON = "";
    public const VIEW = "composers.notebooks.note";

    public static function parentComposer(): string
    {
        return NotebooksItemComposer::class;
    }
}
