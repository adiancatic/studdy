<div class="notebook-preview">
    @if($notebooks->isEmpty())
        @ob
            <button type="button" class="btn btn-md btn-default" onclick="openModal('views.notebooks.modal.edit-notebook-modal', {}, { subject_id: {{ $subjectId }} })"><i class="fal fa-plus"></i>{{ __("Add notebook") }}</button>
        @endob(cta)
        <x-empty-state.basic
            title="{{ __('No notebooks') }}"
            description="{{ __('There are no notebooks, add a new one to start') }}"
            :ctas="[$cta]"
        />
    @else
        <div class="notebook-preview__header">
            <x-dropdown>
                <x-slot:toggle class="btn btn-md btn-default">
                    <i class="fas fa-{{ $selectedNotebook->icon }}"></i><span>{{ $selectedNotebook->title }}</span><i class="far fa-chevron-down"></i>
                </x-slot:toggle>

                @foreach($notebooks as $notebook)
                    <x-dropdown.item type="action">
                        <button type="button" wire:click="$emit('selectNotebook', {{ $notebook->id }})">
                            <i class="fas fa-{{ $notebook->icon }}"></i>
                            {{ $notebook->title }}
                        </button>
                    </x-dropdown.item>
                @endforeach
            </x-dropdown>

            <div class="btn-group">
                <a href="{{ $selectedNotebook->url }}" class="btn btn-md btn-default">{{ __("Open notebook") }}</a>

                <x-dropdown align="end" btnGroup>
                    <x-slot:toggle class="btn btn-md btn-default">
                        <i class="far fa-ellipsis-v"></i>
                    </x-slot:toggle>

                    <x-dropdown.item type="action">
                        <button type="button" wire:click="$emit('confirmAndDeleteNotebook', {{ $selectedNotebook->id }})">
                            <i class="fal fa-trash"></i>
                            {{ __("Delete notebook") }}
                        </button>
                    </x-dropdown.item>
                </x-dropdown>
            </div>
        </div>

        <div class="notebook-preview__body">
            @forelse($selectedNotebook->notes as $note)
                <livewire:components.list-item :model="$note" :index="$loop->iteration" wire:key="{{ $note->id }}" />
            @empty
                @ob
                    <button type="button" class="btn btn-md btn-default" wire:click="addNote"><i class="fal fa-plus"></i>{{ __("Add note") }}</button>
                @endob(cta)

                <x-empty-state.basic
                    title="{{ __('No notes') }}"
                    description="{{ __('There are no notes, add a new one to start') }}"
                    :ctas="[$cta]"
                />
            @endforelse
        </div>
    @endif
</div>
