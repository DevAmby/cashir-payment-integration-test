@extends('layouts.app')

@section('content')
<header class="header">
    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <a href="demo4.html" class="logo">
                    <img src="{{ asset('assets/images/amby-logo.png') }}" width="111" height="44" alt="Porto Logo">
                </a>
            </div><!-- End .header-left -->

        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->
<div class="page-wrapper">
    <main class="main">
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6 mx-auto mt-10">
                            <div class="heading mb-1">
                                <h2 class="title mb-4">Welcome, Login to your account</h2>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <label for="login-email">
                                    Username or email address
                                    <span class="required">*</span>
                                </label>

                                <input id="email" type="email" class="form-control form-wide @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback mb-4" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <label for="login-password">
                                    Password
                                    <span class="required">*</span>
                                </label>

                                <input id="password" type="password" class="form-control form-wide @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <div class="form-footer">
                                    <div class="custom-control custom-checkbox mb-0">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" />
                                        <label class="custom-control-label mb-0" for="remember">Remember me</label>
                                    </div>

                                    <a href="{{ route('register') }}" class="forget-password text-dark form-footer-right">Create a New Account</a>
                                </div>
                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    LOGIN
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->
</div><!-- End .page-wrapper -->
@endsection
