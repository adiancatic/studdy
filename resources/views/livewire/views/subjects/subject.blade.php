<div class="subject">
    @livewire("components.breadcrumbs", ["node" => static::class])

    <div class="container">
        <div class="subject__header">
            <div class="subject__info">
                <i class="fad fa-{{ $subject->icon }}"></i>
                <h1 class="subject__title">{{ $subject->title }}</h1>
            </div>

            <button type="button" class="btn btn-md btn-default" onclick="openModal('views.subjects.modal.edit-subject-modal', { 'id' : {{ $subject->id }} })">
                <i class="far fa-pen"></i>{{ __("Edit subject") }}
            </button>
        </div>

        <div class="row">
            <livewire:components.notebook-preview subject="{{ $subject->id }}" />
        </div>

    </div>
</div>
