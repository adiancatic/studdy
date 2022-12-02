@extends('layouts.master')

@section('head')
    <!-- Scripts -->
    @vite([
        'resources/plugins/fontawesome/css/all.min.css',
        'resources/scss/app.scss',
        'resources/js/app.js',
    ])
@endsection

@section('body')
    <body>
        <x-navigation/>

        <main>
            @yield('content')
        </main>
    </body>
@endsection
