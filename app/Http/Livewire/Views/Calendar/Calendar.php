<?php

namespace App\Http\Livewire\Views\Calendar;

use App\Http\Livewire\Views\AbstractView;
use Carbon\Carbon;

class Calendar extends AbstractView
{
    protected const TITLE = "Calendar";
    public const ICON = "calendar";

    public function render()
    {
        return view('livewire.views.calendar');
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
