<?php

namespace App\Http\Livewire\Components;

use App\Helpers\DI;
use App\Http\Livewire\Views\Calendar\Calendar;
use App\Http\Livewire\Views\Dashboard;
use App\Http\Livewire\Views\Notebooks\NotebookList;
use App\Http\Livewire\Views\Quizzes\QuizList;
use App\Http\Livewire\Views\Subjects\SubjectList;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Navigation extends Component
{
    public const VIEWS = [
        Dashboard::class,
        SubjectList::class,
        NotebookList::class,
        QuizList::class,
        Calendar::class,
    ];

    public const TEMP_URL_MAP = [
        Dashboard::class => 'dashboard',
        SubjectList::class => 'subjects',
        NotebookList::class => 'notebooks',
        QuizList::class => 'quizzes',
        Calendar::class => 'calendar',
    ];

    protected $activeView;

    public function mount()
    {
        $this->setActiveView(Request::segment(1));
    }

    public static function getViews()
    {
        $views = [];

        foreach (self::VIEWS as $view) {
            $views[] = DI::get($view);
        }

        return $views;
    }

    public function getActiveView()
    {
        return $this->activeView;
    }

    public function setActiveView($activeView)
    {
        $this->activeView = $activeView;
        return $this;
    }

    public function render()
    {
        return view('livewire.components.navigation');
    }
}
