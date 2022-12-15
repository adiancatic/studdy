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

</div>
