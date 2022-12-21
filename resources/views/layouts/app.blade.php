@extends('layouts.master')

@section('head')
    @livewireStyles
    <link rel="stylesheet" href="{{ mix('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('body')
    <body>
        @livewire("components.navigation")

        <main>
            {{ $slot }}
        </main>

        @livewireScripts
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
@endsection
