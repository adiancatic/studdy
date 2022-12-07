<div>
    @livewire("components.breadcrumbs", ["node" => static::class])

    <h1>{{ $note->title }}</h1>

    @if($note->content)
        <div class="note-content">{{ $note->content }}</div>
    @endif
</div>
