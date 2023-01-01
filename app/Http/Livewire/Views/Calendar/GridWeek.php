<?php

namespace App\Http\Livewire\Views\Calendar;

use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GridWeek extends Component
{
    /** @var Carbon */
    public $now;
    public $offset;
    public $offsetType = Calendar::TYPE_WEEK;

    protected $listeners = [
        "refresh" => '$refresh',
    ];

    public function getPeriod()
    {
        $start = $this->now->startOfWeek(Carbon::MONDAY);
        $end = $start->addWeek()->subDay();

        return CarbonPeriod::create($start, "1 day", $end);
    }

    public function getEvents()
    {
        $dates = $this->getPeriod();

        /** @var Event[] $events */
        $events = Auth::user()->events->whereBetween("date_start", [
            $dates->start->startOfDay()->format("Y-m-d H:i:s"),
            $dates->end->endOfDay()->format("Y-m-d H:i:s"),
        ]);

        return $events;
    }

    public function render()
    {
        return view('livewire.views.calendar.grid-week');
    }
}
