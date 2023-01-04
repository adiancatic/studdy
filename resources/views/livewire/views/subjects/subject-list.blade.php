<div class="subject-list">
    @if($subjects->isEmpty())
        @php
            ob_start();
            @endphp
            <button type="button" class="btn btn-md btn-default" onclick="openModal('views.subjects.modal.edit-subject-modal')"><i class="fal fa-plus"></i>{{ __("Add subject") }}</button>
            @php
            $cta = ob_get_clean();
        @endphp

        <x-empty-state.basic
            icon="bookmark"
            title="{{ __('No subjects') }}"
            description="{{ __('There are no subjects, add a new one to start') }}"
            :ctas="[$cta]"
        />
    @else
        <div class="container">
            <div class="subject-list__header">
                <h1 class="subject-list__title">{{ __("Subjects") }}</h1>
                <button type="button" class="btn btn-md btn-default" onclick="openModal('views.subjects.modal.edit-subject-modal')"><i class="fal fa-plus"></i>{{ __("Add subject") }}</button>
            </div>

            <div class="row">
                @foreach($subjects as $subject)
                    <div class="col-4">
                        <livewire:components.subject-card :model="$subject" wire:key="{{ $subject->id }}" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
