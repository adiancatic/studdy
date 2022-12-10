@extends('layouts.master')

@section('head')
    @livewireStyles
    @vite([
        'resources/plugins/fontawesome/css/all.min.css',
        'resources/scss/app.scss',
    ])
@endsection

@section('body')
    <body>
        @livewire("components.navigation")

        <main>
            {{ $slot }}
        </main>

        @livewireScripts
        @vite([
            'resources/js/app.js',
        ])
    </body>
@endsection
