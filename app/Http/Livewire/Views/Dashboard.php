<?php

namespace App\Http\Livewire\Views;

class Dashboard extends AbstractView
{
    protected const TITLE = "Dashboard";
    public const ICON = "objects-column";

    public function render()
    {
        return view('livewire.views.dashboard');
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
