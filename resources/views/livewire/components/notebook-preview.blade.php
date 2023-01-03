<div class="notebook-preview">
    @if($notebooks->isEmpty())
        no notes
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

            <a href="{{ $selectedNotebook->url }}" class="btn btn-md btn-default">{{ __("See notebook") }}</a>
        </div>

        <div class="notebook-preview__body">
            @foreach($selectedNotebook->notes as $note)
                <livewire:components.list-item :item="$note" :index="$loop->iteration" wire:key="{{ $note->id }}" />
            @endforeach
        </div>
    @endif
</div>
