<?php

namespace App\View\Composers\Notebooks;

use App\Models\Notebook;
use App\View\Composers\AbstractItemComposer;

class NotebooksItemComposer extends AbstractItemComposer
{
    public const MODEL = Notebook::class;

    protected const TITLE = "Note";
    public const ICON = "book";
    public const VIEW = "composers.notebooks.item";

    public static function parentComposer(): string
    {
        return NotebooksListComposer::class;
    }
}
