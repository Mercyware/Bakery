@extends('layouts.app')

@section('content')

    <div class="container">

        <div class=" row justify-content-center">
            <div class="col-md-4 ">


                <h2 class="text-primary text-center">Bakery Manager</h2>
                <div class="card">

                    <div class="card-body">

                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Email Address</label>


                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class=" control-label">Password</label>


                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        Login
                                    </button>


                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="card-footer" style="font-weight: 100; font-size: 12px">

                        <p class="text-left">
                            <a href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a></p>
                    </div>

                    <div class="col-md-12">
                        <h3>Default Login Details</h3>
                        <p><strong>User :</strong> emmanuel@paystack.com</p>
                        <p><strong>Password :</strong> password</p>


                    </div>
                </div>


            </div>
        </div>


    </div>







@endsection
