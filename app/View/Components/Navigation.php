<?php

namespace App\View\Components;

use App\Http\Controllers\DashboardController;
use App\View\Composers\DashboardComposer;
use App\View\Composers\NotebooksComposer;
use Illuminate\View\Component;

class Navigation extends Component
{
    public const COMPOSERS = [
        DashboardComposer::class,
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function getComposers()
    {
        $composers = [];

        foreach (self::COMPOSERS as $composer) {
            $composers[] = new $composer;
        }

        return $composers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navigation');
    }
}
