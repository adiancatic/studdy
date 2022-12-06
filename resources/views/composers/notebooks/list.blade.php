@extends('layouts.app')

@section('content')
    @if(! $items->isEmpty())
        <div class="notebooks-list">
            @foreach($items as $item)
                <a href="/notebooks/{{ $item->id }}" class="notebook-item">
                    <div class="notebook-item__icon">
                        <i class="fad fa-{{ $item->icon }}"></i>
                    </div>
                    <div class="notebook-item__info">
                        <h5 class="notebook-item__title">{{ $item->title }}</h5>
                        <span class="notebook-item__note-count">{{ $item->notes->count() }} {{ __("notes") }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection
