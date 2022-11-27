@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1>{{ $title }}</h1>
        @if(isset($notebooks))
            <ul>
                @foreach($notebooks as $notebook)
                    <li>
                        <a href="/notebooks/{{ $notebook->id }}">
                            <i class="fad fa-{{ $notebook->icon }}"></i>
                            <span>{{ $notebook->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
