@php
    use App\Http\Livewire\Views\Calendar\Calendar;
@endphp
<div class="calendar__header">
    <h4>{{ $now->monthName }} {{ $now->year }}</h4>

    <div class="calendar__actions">
        <x-dropdown align="end">
            <x-slot:toggle class="btn btn-md btn-default">
                <span>{{ __(Calendar::TYPES[$offsetType]) }}</span><i class="far fa-chevron-down"></i>
            </x-slot:toggle>

            <x-dropdown.item type="action">
                <button type="button"
                        wire:click="$emit('setOffset', 0, '{{ Calendar::TYPE_WEEK }}')">{{ __(Calendar::TYPES[Calendar::TYPE_WEEK]) }}</button>
            </x-dropdown.item>

            <x-dropdown.item type="action">
                <button type="button"
                        wire:click="$emit('setOffset', 0, '{{ Calendar::TYPE_MONTH }}')">{{ __(Calendar::TYPES[Calendar::TYPE_MONTH]) }}</button>
            </x-dropdown.item>
        </x-dropdown>

        <div class="btn-group" role="group">
            <button
                type="button"
                class="btn btn-md btn-default"
                wire:click="$emit('setOffset', {{ $offset - 1 }}, '{{ $offsetType }}')">
                <i class="far fa-chevron-left"></i>
            </button>

            <button
                type="button"
                class="btn btn-md btn-default"
                wire:click="$emit('setOffset', 0, '{{ $offsetType }}')">
                Today
            </button>

            <button
                type="button"
                class="btn btn-md btn-default"
                wire:click="$emit('setOffset', {{ $offset + 1 }}, '{{ $offsetType }}')">
                <i class="far fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
