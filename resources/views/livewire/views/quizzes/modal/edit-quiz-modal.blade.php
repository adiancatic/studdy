<x-modal.modal center size="lg">
    <x-slot name="header">
        <h1 class="modal-title fs-5" wire:ignore>{{ $model->title ?: __("Add quiz") }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    <form id="edit-subject-modal-form" wire:submit.prevent="validateAndSave(Object.fromEntries(new FormData($event.target)))">
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

        <div class="row">
            <label class="form-label col-4">{{ __("Bind with note") }}</label>
            <div class="col-8">
                <select class="form-select" wire:model="model.note_id">
                    <option value="0">-</option>
                    @foreach(\Illuminate\Support\Facades\Auth::user()->notebooks as $notebook)
                        <optgroup label="{{ $notebook->title }}">
                            @foreach($notebook->notes as $note)
                                <option value="{{ $note->id }}">{{ $note->title }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="edit-subject-modal-form" class="btn btn-primary">Save changes</button>
    </x-slot>
</x-modal.modal>
