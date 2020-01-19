@extends('layouts.auth')

@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1>Register Form</h1>
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
                        <input type="text" class="form-control @error('username') parsley-error @enderror"
                               name="username" value="{{ old('username') }}" placeholder="Username"/>
                        @error('username')
                        <p class="text-danger text-left">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div>
                        <input type="text" class="form-control @error('email') parsley-error @enderror"
                               name="email" value="{{ old('email') }}" placeholder="email"/>
                        @error('email')
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
                    <div>
                        <input type="password" class="form-control"
                               name=" password_confirmation" placeholder="Password"/>
                    </div>
                    <br/>
                    <div>
                        <button class="btn btn-primary" type="submit">{{ __('Register') }}</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

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
