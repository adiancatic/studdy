<?php

namespace App\Http\Livewire\Views\Subjects;

use App\Helpers\BreadcrumbTrait;
use App\Http\Livewire\Views\AbstractView;
use Illuminate\Support\Facades\Auth;

class SubjectList extends AbstractView
{
    use BreadcrumbTrait;

    protected const TITLE = "Subjects";
    public const ICON = "bookmark";

    public $subjects;

    protected $listeners = [
        "refresh" => '$refresh',
    ];

    public function breadcrumbConf()
    {
        return [
            "title" => "Subjects",
            "urlSegment" => "subjects",
        ];
    }

    public function render()
    {
        $this->subjects = Auth::user()->subjects;

        return view('livewire.views.subjects.subject-list');
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
