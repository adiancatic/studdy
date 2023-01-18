<x-modal.modal center size="lg">
    <x-slot name="header">
        <h1 class="modal-title fs-5" wire:ignore>{{ __("Finish quiz") }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    <form id="finish-quiz-modal-form" wire:submit.prevent="validateAndSave(Object.fromEntries(new FormData($event.target)))">
        @if($model->id)
            <input type="hidden" name="id" value="{{ $model->id }}">
        @endif

        <div class="rating">
            @foreach(range(1, 5) as $ratingMark)
                <input type="radio" wire:change="$set('rating', {{ $ratingMark }})" name="rating" id="rating-{{ $ratingMark }}" autocomplete="off">
                <label class="btn btn-default btn-lg btn-rate" for="rating-{{ $ratingMark }}">{{ $ratingMark }}</label>
            @endforeach
        </div>
    </form>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="finish-quiz-modal-form" @disabled(! $rating) class="btn btn-primary">{{ __("Finish quiz") }}</button>
    </x-slot>
</x-modal.modal>
