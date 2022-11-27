<?php

namespace App\View\Composers\Notebooks;

use App\Models\Notebook;
use App\View\Composers\AbstractComposer;
use Illuminate\View\View;

class NotebooksItemComposer extends AbstractComposer
{
    protected const TITLE = "Note";
    public const ICON = "book";
    public const VIEW = "composers.notebooks.item";

    protected Notebook $notebook;

    public function compose(View $view): void
    {
        parent::compose($view);

        $this->setNotebook($view->getData()["notebook"]);
    }

    /**
     * @return Notebook
     */
    public function getNotebook(): Notebook
    {
        return $this->notebook;
    }

    /**
     * @param Notebook $notebook
     * @return NotebooksItemComposer
     */
    public function setNotebook(Notebook $notebook)
    {
        $this->notebook = $notebook;
        return $this;
    }
}
