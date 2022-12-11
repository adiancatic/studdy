@extends('layouts.master')

@section('head')
    @livewireStyles
    @vite([
        'resources/plugins/fontawesome/css/all.min.css',
        'resources/scss/app.scss',
        'resources/js/app.js',
    ])
@endsection

@section('body')
    <body>
        @livewire("components.navigation")

        <main>
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
@endsection
