<?php

namespace App\Http\Livewire\Views\Calendar;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Livewire\Component;

class GridMonth extends Component
{
    /** @var Carbon */
    public $now;
    public $offset;
    public $offsetType = Calendar::TYPE_MONTH;

    public function getGrid()
    {
        $firstWeekDayOfMonth = $this->now->firstOfMonth()->dayOfWeekIso;

        // var_dump($date->getDaysFromStartOfWeek()
        $start = $this->now->firstOfMonth()->add(1 - $firstWeekDayOfMonth, "day");
        $end = $start->add(6, "week")->subDay();

        return CarbonPeriod::create($start, "1 day", $end);
    }

    public function render()
    {
        return view('livewire.views.calendar.grid-month');
    }
}
