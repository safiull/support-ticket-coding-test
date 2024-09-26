@extends('layouts.auth.app', [
    'title' => __('Password Reset')
])

@section('contents')
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2">Reset Password 🔒</h4>
                        <p class="mb-4">for <span class="fw-medium">{{ request('email') }}</span></p>

                        <form id="formAuthentication" class="mb-3 custom-reload-form" action="{{ route('password.store') }}" method="POST">
                            @csrf

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter new password" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <input type="hidden" name="email" value="{{ request('email') }}" readonly />
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="confirm-password">{{ __('Confirm Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirm-password" class="form-control" name="password_confirmation" placeholder="Enter confirm password" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-3 ajax-btn">
                                {{ __('Set new password') }}
                            </button>

                            <div class="text-center">
                                <a href="{{ route('login') }}">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    {{ __('Back to login') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
