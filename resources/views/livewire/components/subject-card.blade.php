<div class="subject-card">
    <div class="subject-card__header">
        <a href="/subjects/{{ $model->id }}" class="subject-card__info">
            <div class="subject-card__icon">
                <i class="fas fa-{{ $model->icon }}"></i>
            </div>

            <h5 class="subject-card__title">{{ $model->title }}</h5>
        </a>

        <x-dropdown align="end">
            <x-slot name="toggle" class="btn btn-md btn-default">
                <i class="far fa-ellipsis-v"></i>
            </x-slot>

            <x-dropdown.item type="action">
                <button type="button" onclick="openModal('views.subjects.modal.edit-subject-modal', { 'id' : {{ $model->id }} })">
                    <i class="far fa-pen"></i>{{ __("Edit subject") }}
                </button>
            </x-dropdown.item>

            <x-dropdown.item type="action">
                <button type="button" wire:click="confirmAndDelete">
                    <i class="far fa-trash"></i>{{ __("Delete subject") }}
                </button>
            </x-dropdown.item>
        </x-dropdown>
    </div>

    <div class="subject-card__body">
        @if(! $model->notebooks->isEmpty())
            <div class="subject-card__stat-item">
                <i class="fas fa-fw fa-book"></i>
                {{ __("Notebooks") }}
                <span class="subject-card__stat-count">{{ $model->notebooks->count() }}</span>
            </div>
        @endif
    </div>
</div>
