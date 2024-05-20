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
                            <div class="col-md-6 mx-auto mt-5">
                                <div class="heading mb-1">
                                    <h2 class="title mb-4">Create your E-commerce account</h2>
                                </div>

                                <form action="{{ route('register') }}" method="POST" id="register-form">
                                    @csrf

                                    <label for="name" class="form-label">
                                        Full Name
                                        <span class="required">*</span>
                                    </label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="email" class="form-label">
                                        Email address
                                        <span class="required">*</span>
                                    </label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="password" class="form-label">
                                        Password
                                        <span class="required">*</span>
                                    </label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="password-confirm" class="form-label">
                                        Confirm Password
                                        <span class="required">*</span>
                                    </label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">


                                    <div class="form-footer">
                                        <a href="{{ route('login') }}"
                                            class="forget-password text-dark form-footer-left">Already have an account?
                                            Login Here</a>
                                    </div>

                                    <div class="form-footer mb-2">
                                        <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main><!-- End .main -->
    </div><!-- End .page-wrapper -->
@endsection
