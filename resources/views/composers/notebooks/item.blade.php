@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1>{{ $notebook->title }}</h1>
        @if(isset($notebook->notes))
            <ul>
                @foreach($notebook->notes as $note)
                    <li>
                        <a href="/notebooks/{{ $notebook->id }}/{{ $note->id }}">
                            <span>{{ $note->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
