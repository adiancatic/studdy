<div class="note">
    @livewire("components.breadcrumbs", ["node" => static::class])

    <div class="note__container">
        <h1 class="note__title">{{ $note->title }}</h1>
        <div wire:ignore id="editorjs"></div>
    </div>

    <script>
        let item = @js($note)
    </script>
</div>
