<div>
    @livewire("components.breadcrumbs", ["node" => static::class])

    <div class="item-list">
        @if(! $quizzes->isEmpty())
            <div class="item-list__header">
                <h1 class="item-list__title">
                    <i class="far fa-question-circle"></i>
                    {{ __("Quizzes") }}
                </h1>
                <div class="item-list__actions">
                    <button class="btn btn-blank" onclick="openModal('views.quizzes.modal.edit-quiz-modal')"><i class="fal fa-plus"></i></button>
                </div>
            </div>

            <div wire:sortable="updateOrder" class="item-list__body">
                @foreach($quizzes as $quiz)
                    @ob
                        <x-dropdown>
                            <x-slot:toggle>
                                <i class="far fa-fw fa-ellipsis-v"></i>
                            </x-slot:toggle>

                            <x-dropdown.item type="action">
                                <a href="{{ $quiz->url }}">
                                    <i class="fas fa-fw fa-play"></i>{{ __("Start") }}
                                </a>
                            </x-dropdown.item>
                            <x-dropdown.item type="action">
                                <button type="button" wire:click="edit('views.quizzes.modal.edit-quiz-modal')">
                                    <i class="far fa-fw fa-pen"></i>{{ __("Edit") }}
                                </button>
                            </x-dropdown.item>

                            <x-dropdown.item type="divider" />

                            <x-dropdown.item type="action">
                                <button type="button" wire:click="confirmAndDelete">
                                    <i class="far fa-fw fa-trash"></i>{{ __("Delete") }}
                                </button>
                            </x-dropdown.item>
                        </x-dropdown>
                    @endob(dropdown)

                    @ob
                        <div>
                            @php($note = \App\Models\Note::find($quiz->note_id))
                            @php($subject = $note?->notebook?->subject)
                            @if($subject)
                                <a href="{{ $note?->url }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __("Subject") }}">
                                    <i class="fas fa-{{ $subject->icon }}"></i> {{ $subject->title }}
                                </a>
                            @endif
                        </div>
                        <div>
                            @php($logs = $quiz->logs)
                            @php($rating = $logs->average("rating"))
                            @if($rating)
                                <x-progress-line :actual="$rating" max="5" tooltip="Rating" />
                            @endif
                        </div>
                    @endob(columns)

                    @php($hasEntries = ! $quiz->entries->isEmpty())
                    <livewire:components.list-item
                        :index="$loop->iteration"
                        :model="$quiz"
                        :isSortable="true"
                        :dropdown="$dropdown"
                        :showCta="$hasEntries"
                        cta="Start"
                        :columns="$columns"
                        wire:key="{{ $quiz->id }}" />
                @endforeach

                <div class="item-list__item">
                    <span class="item-list__item-index"></span>
                    <button type="button" class="btn btn-default" onclick="openModal('views.quizzes.modal.edit-quiz-modal')">{{ __("Add quiz") }}</button>
                </div>
            </div>
        @else
            @ob
                <button type="button" class="btn btn-default" onclick="openModal('views.quizzes.modal.edit-quiz-modal')">
                    <i class="fal fa-plus"></i>{{ __("Add quiz") }}
                </button>
            @endob(cta)

            <x-empty-state.basic
                icon="question-circle"
                title="{{ __('No quizzes') }}"
                description="{{ __('There are no quizzes, add a new one to start') }}"
                :ctas="[$cta]"
            />
        @endif
    </div>
</div>
