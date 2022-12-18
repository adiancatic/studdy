<div class="calendar">

    <livewire:views.calendar.header
        :now="$now"
        :offset="$offset"
        :offsetType="$offsetType"
        key="header-{{ $offsetType }}-{{ $offset }}" />

    @switch($offsetType)
        @case(self::TYPE_WEEK)
            <livewire:views.calendar.grid-week
                :now="$now"
                :offset="$offset"
                :offsetType="$offsetType"
                key="{{ $offsetType }}-{{ $offset }}" />
            @break

        @case(self::TYPE_MONTH)
            <livewire:views.calendar.grid-month
                :now="$now"
                :offset="$offset"
                :offsetType="$offsetType"
                key="{{ $offsetType }}-{{ $offset }}" />
            @break
    @endswitch

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.querySelector(".calendar");
            let oldCal;

            Livewire.hook("message.received", () => {
                oldCal = container.querySelector(".calendar__grid").cloneNode(true);

                oldCal.style.position = "absolute";
                oldCal.style.inset = "0";
                oldCal.style.top = container.querySelector(".calendar__grid").getBoundingClientRect().top + "px";
            })

            Livewire.hook("message.processed", () => {
                let newCal = container.querySelector(".calendar__grid");

                if (oldCal.classList.toString() !== newCal.classList.toString()) return;

                const firstDateBeforeUpdate = oldCal.querySelector(".calendar__cell").getAttribute("date");
                const firstDateAfterUpdate = newCal.querySelector(".calendar__cell").getAttribute("date");
                if (Date.parse(firstDateBeforeUpdate) === Date.parse(firstDateAfterUpdate)) return;

                const lastDateOfCurrentPeriod = oldCal.querySelector(".calendar__cell--last-of-period").getAttribute("date");
                const firstDateOfNextPeriod = newCal.querySelector(".calendar__cell--first-of-period").getAttribute("date");
                const newCalIsAfter = Date.parse(lastDateOfCurrentPeriod) < Date.parse(firstDateOfNextPeriod);

                oldCal.classList.add("oldCal");
                newCal.before(oldCal);

                oldCal.style.overflow = "hidden";
                newCal.style.overflow = "hidden";

                const moveIn = (negative = false) => {
                    let val = 30 * (negative ? 1 : -1);

                    return [
                        { transform: `translate3d(${val}%, 0, 0)`, opacity: 0 },
                        { transform: `translate3d(0, 0, 0)`, opacity: 1 },
                    ];
                };

                const moveOut = (negative = false) => {
                    let val = 30 * (negative ? -1 : 1);

                    return [
                        { transform: `translate3d(0, 0, 0)`, opacity: 1 },
                        { transform: `translate3d(${val}%, 0, 0)`, opacity: 0 },
                    ];
                };

                oldCal.getAnimations().forEach(animation => animation.finish());
                let animation = oldCal.animate(
                    moveOut(newCalIsAfter),
                    { duration: 300, easing: "ease-in-out" },
                );
                animation.onfinish = () => {
                    oldCal.remove()
                    oldCal.style.overflow = null;
                    newCal.style.overflow = null;
                };

                newCal.getAnimations().forEach(animation => animation.finish());
                newCal.animate(
                    moveIn(newCalIsAfter),
                    { duration: 300, easing: "ease-in-out" },
                );
            })
        })
    </script>
</div>
