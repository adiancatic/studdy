<x-modal.modal center size="sm" footer="false" class="confirm-delete-modal">
    <x-slot name="header">
        <h1 class="modal-title">
            {{  __("Are you sure you want to delete") }} <strong>{{ $model->title }}</strong>?
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    <div class="button-container">
        <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-default">{{ __("Cancel") }}</button>
        <button type="button" wire:click="delete" class="btn btn-lg btn-danger"><i class="far fa-trash"></i>{{ __("Delete") }}</button>
    </div>
</x-modal.modal>
