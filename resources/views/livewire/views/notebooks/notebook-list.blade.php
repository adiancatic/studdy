<div class="notebooks-list">
    @if($notebooks->isEmpty())
        @php
            ob_start();
        @endphp
        <button type="button" class="btn btn-md btn-default" onclick="openModal('views.notebooks.modal.edit-notebook-modal')"><i class="fal fa-plus"></i>{{ __("Add notebook") }}</button>
        @php
            $cta = ob_get_clean();
        @endphp

        <x-empty-state.basic
            icon="book"
            title="{{ __('No notebooks') }}"
            description="{{ __('There are no notebooks, add a new one to start') }}"
            :ctas="[$cta]"
        />
    @else
        <div class="container">
            <div class="notebooks-list__header">
                <h1 class="notebooks-list__title">{{ __("Notebooks") }}</h1>
                <button type="button" class="btn btn-md btn-default" onclick="openModal('views.notebooks.modal.edit-notebook-modal')"><i class="fal fa-plus"></i>{{ __("Add notebook") }}</button>
            </div>

            <div class="row">
                @foreach($notebooks as $notebook)
                    <div class="col-4">
                        <livewire:components.notebook-card :model="$notebook" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
