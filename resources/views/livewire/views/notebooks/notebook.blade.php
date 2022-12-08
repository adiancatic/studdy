<div>
    @livewire("components.breadcrumbs", ["node" => static::class])

    <div class="item-list">
        @if(! $notes->isEmpty())
            <div class="item-list__header">
                <h1 class="item-list__title">
                    <i class="far fa-note"></i>
                    {{ __("Notes") }}
                </h1>
                <div class="item-list__actions">
                    <button wire:click="addNote({{ $notebook->id }})" class="btn btn-blank" href=""><i class="fal fa-plus"></i></button>
                </div>
            </div>

            <div class="item-list__body">
                @foreach($notes as $note)
                    <div class="item-list__item" wire:key>
                        <span class="item-list__item-index">{{ $loop->iteration }}</span>
                        <span class="item-list__item-title">
                            {{ $note->title }}
                            <a class="btn btn-default btn-xs item-list__item-cta" href="/notebooks/{{ $notes[0]->notebook_id }}/{{ $note->id }}">{{ __("Open") }}</a>
                            <button wire:click="deleteNote({{ $note->id }})" class="btn btn-default btn-xs" href="">Delete</button>
                        </span>
                        <span class="item-list__item-date">
                            <i class="far fa-calendar"></i>
                            {{ $note->created_at->format("d M Y") }}
                        </span>
                        <span class="item-list__item-author">{{ $note->author }}</span>
                    </div>
                @endforeach

                <div class="item-list__item">
                    <span class="item-list__item-index"></span>
                    <button wire:click="addNote({{ $notebook->id }})" class="btn btn-default" href="">Add note</button>
                </div>
            </div>
        @else
            <x-empty-state.basic
                title="Your notebook is empty"
                subtitle="Fill it with notes or quizes"
                icon="note"
            />
        @endif
    </div>
</div>
