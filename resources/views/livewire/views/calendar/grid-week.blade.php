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
        <div class="grid-bg">
            @foreach($this->getPeriod() as $date)
                @php $dateLoop = $loop @endphp
                <div class="cell cell--day">
                    @foreach(range(0, 23) as $hour)
                        <div class="cell cell--hour">
                            @if($dateLoop->first)<span class="label-hour">{{ $hour }}:00</span>@endif
                            @foreach(range(0, 3) as $quarter)
                                <div class="cell cell--quarter">

                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        @foreach($this->getPeriod() as $date)
            @php
                $classes = [
                    "calendar__cell",
                    "calendar__cell-body",
                    "calendar__cell--today" => $date->isToday(),
                    "calendar__cell--first-of-period" => $date->isMonday(),
                    "calendar__cell--last-of-period" => $date->isSunday(),
                ];
            @endphp

            <div @class($classes) date="{{ $date->toDateString() }}">
                @foreach(Calendar::getFilteredEventsForDate($this->getEvents(), $date) as $event)
                    @php
                        $timeStart = \Carbon\Carbon::create($event->date_start);
                        $quartersSinceMidnight = $timeStart->secondsSinceMidnight() / 60 / 15;

                        $timeEnd = \Carbon\Carbon::create($event->date_end);
                        $quartersSinceStart = $timeEnd->diffInMinutes($timeStart) / 15;

                        $timeOffsetStart = $quartersSinceMidnight;
                        $timeOffsetEnd = $quartersSinceMidnight + $quartersSinceStart;
                    @endphp

                    <div class="event" style="grid-row: {{ $timeOffsetStart + 1 }} / {{ $timeOffsetEnd + 1 }}">
                        <div class="event-title">{{ $event->title }}</div>
                        <i class="event-time">{{ $timeStart->format("H:i") }} - {{ $timeEnd->format("H:i") }}</i>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script>
        // document.addEventListener("DOMContentLoaded", () => {
        //     let event = document.querySelector(".event")
        //
        //     let mousePositionStart;
        //     let mousePosition;
        //     let oldPos;
        //
        //     const resize = (e) => {
        //         if (! mousePositionStart) {
        //             mousePositionStart = e.y;
        //         }
        //         mousePosition = e.y;
        //
        //         const diffInQuarters = Math.floor((e.y - mousePositionStart) / 16);
        //         const newPos = (parseInt(getComputedStyle(event, "").gridRowEnd) + diffInQuarters);
        //
        //         if (oldPos !== newPos) {
        //             event.style.gridRowEnd = newPos.toString();
        //
        //             oldPos = parseInt(getComputedStyle(event, "").gridRowEnd)
        //             mousePositionStart = null;
        //         }
        //     }
        //
        //     event.addEventListener("mousedown", e => {
        //         // if (e.offsetY > e.target.getBoundingClientRect().height - 8)
        //         mousePositionStart = e.y;
        //         document.addEventListener("mousemove", resize, false)
        //     })
        //
        //     document.addEventListener("mouseup", () => {
        //         document.removeEventListener("mousemove", resize, false)
        //     })
        // })

        // document.addEventListener("DOMContentLoaded", () => {
        //     let events = document.querySelectorAll(".event");
        //     events.forEach(calEvent => {
        //         calEvent.style.resize = "vertical";
        //         calEvent.style.overflowY = "auto";
        //
        //         let startHeight;
        //
        //         calEvent.addEventListener("mousedown", e => {
        //             startHeight = parseInt(calEvent.getBoundingClientRect().height);
        //         })
        //
        //         calEvent.addEventListener("mouseup", e => {
        //             const currentHeight = parseInt(calEvent.style.height) || calEvent.getBoundingClientRect().height;
        //             const currentGridRow = parseInt(calEvent.style.gridRowEnd);
        //             const heightDiff = currentHeight - startHeight;
        //             const gridDiff = Math.round(heightDiff / 16);
        //
        //             calEvent.style.gridRowEnd = parseInt(currentGridRow + gridDiff);
        //             calEvent.style.height = null;
        //         })
        //     })
        // })
    </script>
</div>
