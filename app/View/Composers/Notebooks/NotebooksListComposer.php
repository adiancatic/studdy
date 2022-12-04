<?php

namespace App\View\Composers\Notebooks;

use App\Models\Notebook;
use App\View\Composers\AbstractRootComposer;
use Illuminate\View\View;

class NotebooksListComposer extends AbstractRootComposer
{
    protected const TITLE = "Notebooks";
    public const ICON = "book";
    public const VIEW = "composers.notebooks.list";

    public static function alias(): string
    {
        return "notebooks";
    }

    public function compose(View $view): void
    {
        parent::compose($view);

        $view->with('items', $this->getNotebooks());
    }

    public function getNotebooks()
    {
        return Notebook::all();
    }
}
