<?php

namespace App\Http\Livewire\Views\Calendar;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Livewire\Component;

class GridWeek extends Component
{
    /** @var Carbon */
    public $now;
    public $offset;
    public $offsetType = Calendar::TYPE_WEEK;

    public function getGrid()
    {
        $start = $this->now->startOfWeek(Carbon::MONDAY);
        $end = $start->addWeek()->subDay();

        return CarbonPeriod::create($start, "1 day", $end);
    }

    public function render()
    {
        return view('livewire.views.calendar.grid-week');
    }
}
