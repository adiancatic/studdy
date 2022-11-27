<?php

namespace App\View\Composers\Notebooks;

use App\Models\Notebook;
use App\View\Composers\AbstractComposer;
use Illuminate\View\View;

class NotebooksListComposer extends AbstractComposer
{
    protected const TITLE = "Notebooks";
    public const ICON = "book";
    public const VIEW = "composers.notebooks.list";

    public function compose(View $view): void
    {
        parent::compose($view);

        $view->with('notebooks', $this->getNotebooks());
    }

    public function getNotebooks()
    {
        return Notebook::all();
    }
}
