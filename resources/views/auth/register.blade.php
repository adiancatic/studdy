@extends('layouts.auth')

@section('content')
    <h1>{{ __('auth.register_title') }}</h1>

    @php
        ob_start();
        if (Route::has('login')) {
            ?>
            <a href="<?= route('login') ?>"><?= __('Login') ?></a>
            <?php
        }
        $loginAnchor = ob_get_clean();
    @endphp

    <p class="auth-description">{{ __('auth.register_description') }} {!! $loginAnchor !!}</p>

    <form class="base-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>

            <div class="col">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

            <div class="col">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>

            <div class="col">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

            <div class="col">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
            </div>
        </div>
    </form>
@endsection
