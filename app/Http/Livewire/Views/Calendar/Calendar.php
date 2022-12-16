<?php

namespace App\Http\Livewire\Views\Calendar;

use App\Http\Livewire\Views\AbstractView;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Cookie;

class Calendar extends AbstractView
{
    protected const TITLE = "Calendar";
    public const ICON = "calendar";

    public const TYPE_WEEK = "week";
    public const TYPE_MONTH = "month";

    public const TYPES = [
        self::TYPE_WEEK => "Week",
        self::TYPE_MONTH => "Month",
    ];

    /** @var Carbon */
    public $now;

    public $offset = 0;
    public $offsetType;

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
        $this->offsetType = Cookie::get("calendar-type", self::TYPE_MONTH);
        $this->now = CarbonImmutable::now();
    }

    public function setOffset($offset, $offsetType)
    {
        $this->offset = $offset;
        $this->setOffsetType($offsetType);
    }

    protected function setOffsetType($offsetType)
    {
        $this->offsetType = $offsetType;
        Cookie::queue("calendar-type", $offsetType, 60 * 24 * 365 * 5);
    }

    public static function getFilteredEventsForDate($events, $date)
    {
        return $events->whereBetween("date", [
            $date->startOfDay()->format("Y-m-d H:i:s"),
            $date->endOfDay()->format("Y-m-d H:i:s"),
        ]);
    }

    public function render()
    {
        $this->now = CarbonImmutable::now()->add($this->offset, $this->offsetType);

        return view('livewire.views.calendar.calendar');
    }
}
