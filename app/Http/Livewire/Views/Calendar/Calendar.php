<?php

namespace App\Http\Livewire\Views\Calendar;

use App\Http\Livewire\Views\AbstractView;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class Calendar extends AbstractView
{
    protected const TITLE = "Calendar";
    public const ICON = "calendar";

    const TYPE_WEEK = "week";
    const TYPE_MONTH = "month";

    /** @var Carbon */
    public $now;

    public $offset = 0;
    public $offsetType = self::TYPE_MONTH;

    protected $listeners = [
        "setOffset",
    ];

    public function getIcon()
    {
        return static::ICON;
    }

    public function getTitle()
    {
        return __(static::TITLE);
    }

    public function mount()
    {
        $this->now = CarbonImmutable::now();
    }

    public function setOffset($offset, $offsetType)
    {
        $this->offset = $offset;
        $this->offsetType = $offsetType;
    }

    public function render()
    {
        $this->now = CarbonImmutable::now()->add($this->offset, $this->offsetType);

        return view('livewire.views.calendar.calendar');
    }
}
