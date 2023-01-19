<x-modal.modal center size="lg">
    <x-slot name="header">
        <h1 class="modal-title fs-5" wire:ignore>{{ $model->title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    <form id="manage-quiz-entries-modal-form" wire:submit.prevent="validateAndSave(Object.fromEntries(new FormData($event.target)))">
        @if($model->id)
            <input type="hidden" name="id" value="{{ $model->id }}">
        @endif

        @foreach($entries as $index => $entry)
            <div class="row mb-5">
                <x-form.divider title="{{ __('Question') }} {{ $loop->iteration }}" />

                <div class="col-11">
                    <div class="row">
                        <div class="col-12">
                            <textarea
                                wire:model.lazy="entries.{{ $index }}.question"
                                class="form-control @error('entries.'.$index.'.question') is-invalid @enderror"
                                rows="2"></textarea>

                                    @error('entries.'.$index.'.question')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <label class="form-label col-2 mt-3">{{ __("Answer") }}</label>
                                <div class="col-10 mt-3">
                            <textarea
                                wire:model.lazy="entries.{{ $index }}.answer"
                                class="form-control @error('entries.'.$index.'.answer') is-invalid @enderror"
                                rows="2"></textarea>

                                    @error('entries.'.$index.'.answer')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger" wire:click="deleteQuestion({{ $index }})">
                        <i class="far fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach

        <button type="button" class="btn btn-default" wire:click="addQuestion"><i class="far fa-plus"></i>{{ __("Add question") }}</button>
    </form>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="manage-quiz-entries-modal-form" class="btn btn-primary">Save changes</button>
    </x-slot>
</x-modal.modal>
