<div class="calendar__header">
    <h4>{{ $now->monthName }} {{ $now->year }}</h4>

    <div class="calendar__actions">
        <div>
            <button wire:click="$emit('setOffset', 0, '{{ \App\Http\Livewire\Views\Calendar\Calendar::TYPE_WEEK }}')" type="button">Week</button>
            <button wire:click="$emit('setOffset', 0, '{{ \App\Http\Livewire\Views\Calendar\Calendar::TYPE_MONTH }}')" type="button">Month</button>
        </div>

        <div>
            <button wire:click="$emit('setOffset', {{ $offset - 1 }}, '{{ $offsetType }}')" type="button"><</button>
            <button wire:click="$emit('setOffset', 0, '{{ $offsetType }}')" type="button">Today</button>
            <button wire:click="$emit('setOffset', {{ $offset + 1 }}, '{{ $offsetType }}')" type="button">></button>
        </div>
    </div>
</div>
