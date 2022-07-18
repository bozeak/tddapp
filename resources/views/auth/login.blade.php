@extends('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">{{ __('Login') }}</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field mb-6">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="control">
                    <input id="email"
                           type="email"
                           class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus
                    >

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="field mb-6">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="control">
                    <input id="password"
                           type="password"
                           class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="current-password"
                    >

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="field mb-6">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="button is-link mr-2">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="is-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
