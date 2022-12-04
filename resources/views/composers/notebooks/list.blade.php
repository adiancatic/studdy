@extends('layouts.app')

@section('content')
    <div>
        <x-breadcrumbs :for="$self::class"/>

        @if(isset($items))
            <ul>
                @foreach($items as $item)
                    <li>
                        <a href="/notebooks/{{ $item->id }}">
                            <i class="fad fa-{{ $item->icon }}"></i>
                            <span>{{ $item->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
