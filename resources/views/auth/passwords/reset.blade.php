@extends('layouts.auth')

@section('content')
    <main class="authentication-content">
        <div class="container-fluid">
            <div class="authentication-card">
                <div class="card shadow rounded-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                            <img src="{{ asset('assets/backend/images/error/forgot-password-frent-img.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Genrate New Password</h5>
                                <p class="card-text mb-5">We received your reset password request. Please enter your new password!</p>
                                <form class="form-body" method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email ID</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                                <input id="email" type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputNewPassword" class="form-label">New Password</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" id="inputNewPassword" placeholder="Enter New Password" name="password" required autocomplete="new-password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control radius-30 ps-5" id="inputConfirmPassword" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid gap-3">
                                                <button type="submit" class="btn btn-primary radius-30">Change Password</button>
                                                <a href="{{ route('login') }}" class="btn btn-light radius-30">Back to Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
