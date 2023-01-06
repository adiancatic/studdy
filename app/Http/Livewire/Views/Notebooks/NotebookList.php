<?php

namespace App\Http\Livewire\Views\Notebooks;

use App\Helpers\BreadcrumbTrait;
use Illuminate\Support\Facades\Auth;

class NotebookList extends \App\Http\Livewire\Views\AbstractView
{
    use BreadcrumbTrait;

    protected const TITLE = "Notebook";
    public const ICON = "book";

    /** @var \App\Models\Notebook */
    public $notebooks;

    protected $listeners = [
        "refresh" => '$refresh',
    ];

    public function breadcrumbConf()
    {
        return [
            "title" => "Notebooks",
            "urlSegment" => "notebooks",
        ];
    }

    public function mount()
    {
        $this->notebooks = Auth::user()->notebooks;
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
