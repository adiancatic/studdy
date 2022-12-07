<div class="notebooks-list">
    @if(! $notebooks->isEmpty())
        @foreach($notebooks as $notebook)
            <a href="/notebooks/{{ $notebook->id }}" class="notebook-item">
                <div class="notebook-item__icon">
                    <i class="fad fa-{{ $notebook->icon }}"></i>
                </div>
                <div class="notebook-item__info">
                    <h5 class="notebook-item__title">{{ $notebook->title }}</h5>
                    <span class="notebook-item__note-count">{{ $notebook->notes->count() }} {{ __("notes") }}</span>
                </div>
            </a>
        @endforeach
    @endif
</div>
