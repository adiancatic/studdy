<div class="notebook-card" wire:key="{{ $model->id }}">
    <div class="notebook-card__content">
        <div class="notebook-card__icon">
            <i class="fad fa-{{ $model->icon }}"></i>
        </div>
        <div class="notebook-card__info">
            <a href="/notebooks/{{ $model->id }}" class="notebook-card__title">{{ $model->title }}</a>
            <span class="notebook-card__note-count">{{ $model->notes->count() }} {{ __("notes") }}</span>
        </div>
    </div>

    <x-dropdown align="end">
        <x-slot name="toggle" class="btn btn-md btn-default">
            <i class="far fa-ellipsis-v"></i>
        </x-slot>

        <x-dropdown.item type="action">
            <button type="button" onclick="openModal('views.notebooks.modal.edit-notebook-modal', { 'id' : {{ $model->id }} })">
                <i class="far fa-pen"></i>{{ __("Edit notebook") }}
            </button>
        </x-dropdown.item>

        <x-dropdown.item type="action">
            <button type="button" wire:click="confirmAndDelete">
                <i class="far fa-trash"></i>{{ __("Delete notebook") }}
            </button>
        </x-dropdown.item>
    </x-dropdown>
</div>
