@extends('layouts.auth.app', [
    'title' => __('Forget Password')
])

@section('contents')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">

                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">{{ __('Forgot Password?') }} 🔒</h4>
                        <p class="mb-4">{{ __("Enter your email and we'll send you instructions to reset your password") }}</p>

                        <form id="formAuthentication" class="mb-3 ajax-form" action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter your email') }}" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100 ajax-button">{{ __('Send Reset Link') }}</button>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                {{ __('Back to login') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
