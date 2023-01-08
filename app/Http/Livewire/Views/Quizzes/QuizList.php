<?php

namespace App\Http\Livewire\Views\Quizzes;

use App\Helpers\BreadcrumbTrait;
use App\Http\Livewire\Views\AbstractView;

class QuizList extends AbstractView
{
    use BreadcrumbTrait;

    protected const TITLE = "Quizzes";
    public const ICON = "question-circle";

    public function breadcrumbConf()
    {
        return [
            "title" => "Quizzes",
            "urlSegment" => "quizzes",
        ];
    }

    public function render()
    {
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
