<?php

namespace App\Http\Livewire\Views\Quizzes;

use App\Helpers\BreadcrumbTrait;
use App\Http\Livewire\Views\AbstractView;
use Illuminate\Support\Facades\Auth;

class QuizList extends AbstractView
{
    use BreadcrumbTrait;

    protected const TITLE = "Quizzes";
    public const ICON = "question-circle";

    protected $listeners = [
        "refresh" => '$refresh',
    ];

    public $quizzes;

    public function updateOrder($items)
    {
        $order = collect($items)->pluck("order", "value")->toArray();

        foreach ($this->quizzes as $quiz) {
            // dump("before: {$quiz->order} | after: {$order[$quiz->id]}");
            $quiz->order = $order[$quiz->id];
            $quiz->save();
        }

        $this->quizzes = Auth::user()->fresh()->quizzes()->orderBy("order")->get();
        $this->emit("refresh");
    }

    public function breadcrumbConf()
    {
        return [
            "title" => "Quizzes",
            "urlSegment" => "quizzes",
        ];
    }

    public function render()
    {
        $this->quizzes = Auth::user()->quizzes()->orderBy("order")->get();

        return view('livewire.views.quizzes.quiz-list');
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
