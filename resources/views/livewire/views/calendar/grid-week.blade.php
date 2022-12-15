<div class="calendar__grid calendar__grid--week">
    <div class="calendar__grid-header">
        @php
            $weekdays = \Carbon\Carbon::DAYS_PER_WEEK;
            $weekday = $now->copy()->startOfWeek()->subDay();
        @endphp

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
        @foreach($this->getGrid() as $date)
            @php
                $classes = [
                    "calendar__cell",
                    "calendar__cell--today" => $date->isToday(),
                ];
            @endphp

            <div @class($classes)>
                <div class="calendar__cell-header">
                    <span class="calendar__cell-header-date">{{ $date->format("d") }}</span>
                </div>
                <div class="calendar__cell-body">

                </div>
            </div>
        @endforeach
    </div>
</div>
