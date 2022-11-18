@extends('layouts.auth')

@section('content')
    <h1>{{ __('auth.login_title') }}</h1>

    @php
        ob_start();
        if (Route::has('register')) {
            ?>
            <a href="<?= route('register') ?>"><?= __('Register') ?></a>
            <?php
        }
        $registrationAnchor = ob_get_clean();
    @endphp

    <p class="auth-description">{{ __('auth.login_description') }} {!! $registrationAnchor !!}</p>

    <form class="base-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row">
            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

            <div class="col">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>

            <div class="col">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>

                {{--todo setup password reset page--}}
                {{--@if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                @endif--}}
            </div>
        </div>
    </form>
@endsection
