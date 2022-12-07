<?php

namespace App\Http\Livewire\Views\Notebooks;

use App\Helpers\BreadcrumbTrait;

class NotebookList extends \App\Http\Livewire\Views\AbstractView
{
    use BreadcrumbTrait;

    protected const TITLE = "Notebook";
    public const ICON = "book";

    /** @var \App\Models\Notebook */
    public $notebooks;

    public function breadcrumbConf()
    {
        return [
            "title" => "Notebooks",
            "urlSegment" => "notebooks",
        ];
    }

    public function mount()
    {
        $this->notebooks = \App\Models\Notebook::all();

    }

    public function render()
    {
        return view('livewire.views.notebooks.notebook-list');
    }

    public function getIcon()
    {
        return static::ICON;
    }

    public function getTitle()
    {
        return __(static::TITLE);
    }
}
