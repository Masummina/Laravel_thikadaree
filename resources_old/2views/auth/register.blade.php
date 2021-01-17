@extends('layouts.app')

@section('content')




  <div class="user-login">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
            <div class="login-logo card1 pb-5">
                <div class="row"> <img src="{{asset('images/home/thikadari.png')}}" class="logo"> </div>
                <div class="px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
            </div>
            </div>

            <div class="col-lg-6">
                    <div class="signup-form">

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <h2>Register</h2>
                <p class="hint-text">Create your account. It's free and only takes a minute.</p>


                <div class="form-group">

                     <label for="name" class="col-form-label">{{ __('Full Name:') }}</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                </div>


                <div class="form-group">
                 <label for="name" class="col-form-label">{{ __('E-Mail Address:') }}</label>

                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                 <div class="form-group">
                 <label for="name" class="col-form-label">{{ __('Password:') }}</label>

                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                  <div class="form-group">
                 <label for="name" class="col-form-label">{{ __('Confirm Password:') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div> 
                <div class="form-group">
                      <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
            <div class="text-center">Already have an account? <a href="{{ url('login') }}">Sign in</a></div>
        </div>
            </div>
        </div>
    </div>
</div>
  </div>
@endsection
