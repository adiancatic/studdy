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
                @foreach($notes as $index => $note)
                    <livewire:components.list-item
                        :index="$loop->iteration"
                        :itemId="$note->id"
                        :title="$note->title"
                        :url="$note->url"
                        :date="$note->created_at->format('d M Y')"
                        :author="$note->author"
                        wire:key="{{ $note->id }}" />
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
