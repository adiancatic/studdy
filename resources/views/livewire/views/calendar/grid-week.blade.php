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

    <div class="calendar__grid-body grid-cols">
        <div class="grid-bg grid-cols">
            @foreach($this->getPeriod() as $date)
                @php $dateLoop = $loop @endphp
                <div class="cell cell--day">
                    <div></div>
                    @foreach([...(range(0, 23)), 0] as $hour)
                        <div class="cell cell--hour">
                            @if($dateLoop->first)<span class="label-hour">{{ $hour }}:00</span>@endif
                            @foreach(range(0, 3) as $quarter)
                                <div class="cell cell--quarter"></div>
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

                /** @var \App\Models\Event[] $events */
                $events = Calendar::getFilteredEventsForDate($this->getEvents(), $date);
                $offsets = [];
            @endphp

            <div @class($classes) date="{{ $date->toDateString() }}">
                @if($date->isToday())
                    <div class="time-line grid-cols">
                        <span class="time-wrapper">
                            <span class="time">00:00</span>
                        </span>
                        <span class="line" style="grid-column: {{ $date->dayOfWeekIso }}"></span>
                    </div>
                @endif

                @foreach($events as $event)
                    @php
                        $timeStart = \Carbon\Carbon::create($event->date_start);
                        $timeEnd = \Carbon\Carbon::create($event->date_end);

                        /*
                         * Rows logic
                         */
                        $quartersSinceMidnight = $timeStart->secondsSinceMidnight() / 60 / 15;
                        $quartersSinceStart = $timeEnd->diffInMinutes($timeStart) / 15;

                        $timeOffsetStart = $quartersSinceMidnight;
                        $timeOffsetEnd = $quartersSinceMidnight + $quartersSinceStart;

                        $gridRowStyle = "grid-row: " . ($timeOffsetStart + 2) . " / " . ($timeOffsetEnd + 2) . ";";

                        /*
                         * Cols logic
                         */
                        $overlapsStart = $events->whereBetween("date_start", [$timeStart, $timeEnd->copy()->subSecond()]);
                        $overlapsEnd = $events->whereBetween("date_end", [$timeStart->copy()->addSecond(), $timeEnd]);

                        $overlapsOutsideStart = $events->where("date_start", "<=", $timeStart);
                        $overlapsOutsideEnd = $events->where("date_end", ">=", $timeEnd);
                        $overlapsOutside = $overlapsOutsideStart->intersect($overlapsOutsideEnd);

                        $overlaps = $overlapsOutside->merge(
                            $overlapsStart->merge($overlapsEnd)
                        );

                        $colCount = $overlaps->count();

                        $offsets[$colCount] = array_key_exists($colCount, $offsets)
                            ? $offsets[$colCount] + 1
                            : 0;

                        if ($colCount === $offsets[$colCount]) {
                            $offsets[$colCount] = 0;
                        }

                        $multiplier = (int) floor(100 / $colCount);

                        $colFrom = ($offsets[$colCount] * $multiplier) + 1;
                        $colTo = $colFrom + $multiplier;

                        if ($colTo === 100) {
                            $colTo = 101;
                        }

                        $gridColStyle = "grid-column: $colFrom / $colTo;";
                    @endphp

                    <div class="event" style="{{ "$gridRowStyle $gridColStyle" }}">
                        <div class="event-title">{{ $event->title }}</div>
                        <i class="event-time">{{ $timeStart->format("H:i") }} - {{ $timeEnd->format("H:i") }}</i>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script>
        const timeline = () => {
            let calendar = document.querySelector(".calendar__grid--week")
            if (! calendar) return

            let calendarBody = calendar.querySelector(".calendar__grid-body")
            if (! calendarBody) return

            let timeline = calendarBody.querySelector(".time-line")
            if (! timeline) return

            timeline.style.opacity = "1"

            const calendarHeight = calendarBody.getBoundingClientRect().height - (2 * 16)
            const minutesInDay = 24 * 60

            const loop = (loadOffset = null) => {
                let now = new Date()

                let then = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0)

                if (! loadOffset) {
                    loadOffset = now.getSeconds() * 1000
                }

                let diff = new Date(now.getTime() - then.getTime())
                diff.setHours(diff.getHours() - 1)

                const minutesSinceMidnight = diff.getHours() * 60 + diff.getMinutes()
                const offsetUnit = calendarHeight / minutesInDay
                const offset = offsetUnit * minutesSinceMidnight + 16

                timeline.querySelector(".time").innerHTML = `${now.getHours()}:${now.getMinutes()}`
                timeline.style.top = `${Math.floor(offset)}px`

                setTimeout(() => {
                    loop(0)
                }, 1000 * 60 - loadOffset)
            }

            loop()
        }

        document.addEventListener("DOMContentLoaded", () => {
            timeline()

            Livewire.hook("message.processed", (e) => {
                const calendar = document.querySelector(".calendar")
                if (!calendar || calendar !== e.component.el) return

                timeline()
            })
        })

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
