@extends('layouts.app')

@section('content')
    <div>
        <x-breadcrumbs :for="$self::class"/>

        <h1>{{ $item->title }}</h1>
        @if($item->content)
            <div class="note-content">{{ $item->content }}</div>
        @endif
    </div>
@endsection
