@extends('layouts.app')

@section('site-content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 h-auto">
      <div class="card h-auto mt-100">
        <div class="card-header fz-20 fw-500 py-10">
          {{ __('Login') }}
        </div>

        <div class="card-body py-80">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-20">
              <label for="email" class="col-md-4 col-form-label text-md-end">
                <span>{{ __('E-Mail Address') }}</span>
              </label>

              <div class="col-md-6">
                <input type="email" name="email" id="email" class="required form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus value="{{ old('email') }}" required />

                @error('email')
                  <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
              </div>
            </div>

            <div class="row mb-20">
              <label for="password" class="col-md-4 col-form-label text-md-end">
                <span>{{ __('Password') }}</span>
              </label>

              <div class="col-md-6">
                <input type="password" name="password" id="password" class="required form-control @error('password') is-invalid @enderror" autocomplete="current-password" required />

                @error('password')
                  <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
              </div>
            </div>

            <div class="row mb-20">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input type="checkbox" name="remember" id="remember" class="form-check-input cur-pointer" {{ old('remember') ? 'checked' : '' }} />

                  <label for="remember" class="form-check-label cur-pointer">
                    {{ __('Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                  </a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
