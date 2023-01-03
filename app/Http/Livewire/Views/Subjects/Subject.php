<?php

namespace App\Http\Livewire\Views\Subjects;

use App\Helpers\BreadcrumbTrait;
use App\Http\Livewire\Views\AbstractView;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class Subject extends AbstractView
{
    use BreadcrumbTrait;

    public $subject;

    protected $listeners = [
        "refresh" => '$refresh',
    ];

    public function breadcrumbConf()
    {
        return [
            "item" => "subject",
            "modelClass" => \App\Models\Subject::class,
            "parentClass" => SubjectList::class,
        ];
    }

    public function mount($subjectId)
    {
        $this->subject = Auth::user()->subjects->find($subjectId);
    }

    public function render()
    {
        return view('livewire.views.subjects.subject');
    }
}
