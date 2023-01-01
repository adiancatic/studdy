@extends('layouts.master')

@section('head')
    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('body')
    <body class="auth-view">
        <div class="auth-splash-screen"></div>
        <div class="auth-form">
            <div class="auth-form-container">
                <img class="logo"
                     src="{{ asset('assets/logo.png') }}"
                     srcset="{{ asset('assets/logo.png') }} 1x, {{ asset('assets/logo@2x.png') }} 2x"
                     alt="{{ config('app.name') }}">

                @yield('content')
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
@endsection
