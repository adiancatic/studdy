<x-modal.modal center size="lg">
    <x-slot name="header">
        <h1 class="modal-title fs-5" wire:ignore>{{ $model->title ?: __("Add event") }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    <form id="edit-event-modal-form" wire:submit.prevent="validateAndSave(Object.fromEntries(new FormData($event.target)))">
        @if($model->id)
            <input type="hidden" name="id" value="{{ $model->id }}">
        @endif

        <div class="row mb-4">
            <label class="form-label col-4">{{ __("Title") }}</label>
            <div class="col-8">
                <input type="text"
                       wire:model.lazy="model.title"
                       class="form-control @error('model.title') is-invalid @enderror"
                       required
                >
                @error('model.title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <x-form.divider title="{{ __('Start date') }}" />

        <div class="row mb-4">
            <label class="form-label col-3">{{ __("Date") }}</label>
            <div class="col-3">
                <input type="date"
                       value="{{ $model->date_start?->format("Y-m-d") }}"
                       class="form-control"
                       onchange="Livewire.emit('setDate', this.value)"
                >
            </div>

            <label class="form-label col-3">{{ __("Time") }}</label>
            <div class="col-3">
                <div class="time-picker" style="display: flex; align-items: center">
                    <select class="form-control" onchange="Livewire.emit('setHour', this.value, false)">
                        @foreach(range(0, 23) as $hour)
                            <option @selected($model->date_start->hour === $hour) value="{{ $hour }}">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}</option>
                        @endforeach
                    </select>
                    :
                    <select class="form-control" onchange="Livewire.emit('setMinute', this.value, false)">
                        @foreach(range(0, 45, 15) as $minute)
                            <option @selected($model->date_start->minute === $minute) value="{{ $minute }}">{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <x-form.divider title="{{ __('End date') }}" />

        <div class="row mb-4">
            <label class="form-label col-3">{{ __("Date") }}</label>
            <div class="col-3">
                <input type="date"
                       value="{{ $model->date_end?->format("Y-m-d") }}"
                       class="form-control"
                       onchange="Livewire.emit('setDate', this.value, true)"
                >
            </div>

            <label class="form-label col-3">{{ __("Time") }}</label>
            <div class="col-3">
                <div class="time-picker" style="display: flex; align-items: center">
                    <select class="form-control" onchange="Livewire.emit('setHour', this.value, true)">
                        @foreach(range(0, 23) as $hour)
                            <option @selected($model->date_end->hour === $hour) value="{{ $hour }}">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}</option>
                        @endforeach
                    </select>
                    :
                    <select class="form-control" onchange="Livewire.emit('setMinute', this.value, true)">
                        @foreach(range(0, 45, 15) as $minute)
                            <option @selected($model->date_end->minute === $minute) value="{{ $minute }}">{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </form>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="edit-event-modal-form" class="btn btn-primary">Save changes</button>
    </x-slot>
</x-modal.modal>
