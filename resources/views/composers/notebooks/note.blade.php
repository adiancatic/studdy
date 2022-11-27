@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1>{{ $note->title }}</h1>
        @if($note->content)
            <div class="note-content">{{ $note->content }}</div>
        @endif
    </div>
@endsection
