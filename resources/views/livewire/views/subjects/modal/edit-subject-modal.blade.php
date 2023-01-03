<x-modal.modal center size="lg">
    <x-slot name="header">
        <h1 class="modal-title fs-5">{{ $subject->title ?: __("Add subject") }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    <form id="edit-subject-modal-form" wire:submit.prevent="save(Object.fromEntries(new FormData($event.target)))">
        @if($subject->id)
            <input type="hidden" name="id" value="{{ $subject->id }}">
        @endif

        <div class="row mb-4">
            <label class="form-label col-4">{{ __("Title") }}</label>
            <div class="col-8">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $subject->title) }}" required autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <label class="form-label col-4">{{ __("Icon") }}</label>
            <div class="col-8">
                <livewire:components.form.icon-picker icon="{{ $subject->icon }}" />
            </div>
        </div>

    </form>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="edit-subject-modal-form" class="btn btn-primary">Save changes</button>
    </x-slot>
</x-modal.modal>
