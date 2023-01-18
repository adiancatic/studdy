<?php

namespace App\Http\Livewire\Views\Quizzes;

use App\Helpers\BreadcrumbTrait;
use App\Models\QuizEntry;

class Quiz extends \App\Http\Livewire\Views\AbstractView
{
    use BreadcrumbTrait;

    /** @var \App\Models\Quiz */
    public $quiz;
    /** @var QuizEntry[] */
    public $entries;
    public $entryIndex = 0;

    protected $listeners = [
        "refresh" => '$refresh',
    ];

    public function breadcrumbConf()
    {
        return [
            "item" => "quiz",
            "modelClass" => \App\Models\Quiz::class,
            "parentClass" => QuizList::class,
        ];
    }

    public function mount($quizId)
    {
        $this->quiz = \App\Models\Quiz::find($quizId);
        $this->entries = $this->quiz->entries;
    }

    public function nextEntry()
    {
        if ($this->hasNextEntry()) {
            $this->entryIndex++;
        }
    }

    public function prevEntry()
    {
        if ($this->hasPrevEntry()) {
            $this->entryIndex--;
        }
    }

    public function hasPrevEntry()
    {
        return $this->entryIndex > 0;
    }

    public function hasNextEntry()
    {
        return $this->entryIndex < $this->entries->count() - 1;
    }

    public function getEntry()
    {
        return $this->entries[$this->entryIndex];
    }

    public function finish()
    {
        // todo
    }

    public function render()
    {
        return view('livewire.views.quizzes.quiz');
    }
}
