@php
    use App\Http\Livewire\Views\Calendar\Calendar;

    $weekdays = \Carbon\Carbon::DAYS_PER_WEEK;
    $weekday = $now->copy()->startOfWeek()->subDay();
@endphp

<div class="calendar__grid calendar__grid--week">
    <div class="calendar__grid-header">
        @while($weekdays--)
            @php
                $weekday = $weekday->addDay();
                $weekdayClasses = [
                    "calendar__weekday",
                    "calendar__weekday--today" => $weekday->isToday(),
                ];
            @endphp

            <div @class($weekdayClasses)>
                <span class="calendar__weekday-date">{{ $weekday->format("D d") }}</span>
            </div>
        @endwhile
    </div>

    <div class="calendar__grid-body">
        @foreach($this->getPeriod() as $date)
            @php
                $classes = [
                    "calendar__cell",
                    "calendar__cell--today" => $date->isToday(),
                    "calendar__cell--first-of-period" => $date->isMonday(),
                    "calendar__cell--last-of-period" => $date->isSunday(),
                ];
            @endphp

            <div @class($classes) date="{{ $date->toDateString() }}">
                <div class="calendar__cell-header">
                    <span class="calendar__cell-header-date">{{ $date->format("d") }}</span>
                </div>
                <div class="calendar__cell-body">
                    @foreach(Calendar::getFilteredEventsForDate($this->getEvents(), $date) as $event)
                        <span class="event">{{ $event->title }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
