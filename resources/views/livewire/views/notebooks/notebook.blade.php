<div>
    @livewire("components.breadcrumbs", ["node" => static::class])

    <div class="item-list">
        @if(! $notes->isEmpty())
            <div class="item-list__header">
                <h1 class="item-list__title">
                    <i class="far fa-note"></i>
                    {{ __("Notes") }}
                </h1>
            </div>

            <div class="item-list__body">
                @foreach($notes as $note)
                    <div class="item-list__item">
                        <span class="item-list__item-index">{{ $loop->iteration }}</span>
                        <span class="item-list__item-title">
                        {{ $note->title }}
                        <a class="btn btn-default btn-xs item-list__item-cta" href="/notebooks/{{ $notes[0]->notebook_id }}/{{ $note->id }}">{{ __("Open") }}</a>
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
                    <button wire:click="addNote({{ $notes[0]->notebook_id }})" class="btn btn-default" href="">Add note</button>
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
