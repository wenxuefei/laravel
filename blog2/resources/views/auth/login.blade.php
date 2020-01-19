@extends('layouts.auth')

@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                               name="name" value="{{ old('name') }}" placeholder="name"/>
                        @error('name')
                        <p class="text-danger text-left">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div>
                        <input type="password" class="form-control @error('password') parsley-error @enderror"
                               name="password" placeholder="Password"/>
                        @error('password')
                        <p class="text-danger text-left">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" placeholder="captcha" name="captcha"
                                   class="form-control @error('captcha') parsley-error @enderror">
                        </div>
                        <div class="col-md-4">
                            <img src="{{captcha_src()}}" onclick="this.src ='{{captcha_src()}}'+Math.random()">
                        </div>
                        @error('captcha')
                        <div class="col-md-12">
                            <p class="text-danger text-left">
                                <strong>{{ $message }}</strong>
                            </p>
                        </div>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <label class="pull-left">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember Me
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div>
                        <button class="btn btn-primary submit" type="submit">Log in</button>
                        @if (Route::has('password.request'))
                            <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
                        @endif
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        @if (Route::has('register'))
                            <p class="change_link">New to site?
                                <a href="{{ route('register') }}" class="to_register"> Create Account </a>
                            </p>
                        @endif


                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and
                                Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
