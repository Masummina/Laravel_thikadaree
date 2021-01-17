@extends('layouts.app')

@section('content')
<div class="user-login">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="login-logo card1 pb-5">
                    <div class="row"> <img src=" {{ asset('images/home/thikadari.png') }}" class="logo"> </div>
                    <div class="px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6" >
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3 login-with-socile">
                        <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
                        <div class="socile facebook text-center mr-3">
                            <div class="fa fa-facebook"></div>
                        </div>
                        <div class="socile twitter text-center mr-3">
                            <div class="fa fa-twitter"></div>
                        </div>
                        <div class="socile login-with-socile linkedin text-center mr-3">
                            <div class="fa fa-linkedin"></div>
                        </div>
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center">Or</small>
                        <div class="line"></div>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row px-3">
                          <label for="email" class="mb-1">
                              <h6 class="mb-0 text-sm">{{ __('Email Address') }}</h6>
                          </label>
                            <input id="email" type="email" class="mb-4 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter a valid email address" autofocus>
                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                       </div>

                    <!--     <div class="form-group row px-3">
                            <label for="email" class="mb-1 col-md-4 col-form-label text-md-right">
                            <h6 class="mb-0 text-sm">Email Address</h6>
                           </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter a valid email address" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                       <div class="form-group row px-3">
                          <label for="password" class="mb-1" >
                              <h6 class="mb-0 text-sm">{{ __('Password') }}</h6>
                          </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" placeholder="Enter a valid password " autofocus>
                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                       </div>



                    <!--     <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                      
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline"> 
                            <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">{{ __('Remember Me') }}
                            </label> 
                        </div> 
                           @if (Route::has('password.request'))
                                    <a class="ml-auto mb-0 text-sm" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                          @endif
                    </div>


                    <!--     <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                      <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Login</button> </div>


                      <!--   <div class="form-group row mb-0">
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
                        </div> -->
                    </form>

                    <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger" href="{{ url('register') }}">Register</a></small> </div>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>


@endsection
