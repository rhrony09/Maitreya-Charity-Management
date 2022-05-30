@extends('layouts.auth')

@section('content')
    <div class="card shadow rounded-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/backend/images/error/login-img.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign Up</h5>
                    <p class="card-text mb-4">See your growth and get consulting support!</p>
                    <hr class="mb-4">
                    <form class="form-body" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 ">
                                <label for="inputName" class="form-label">Name</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                                    <input type="name" class="form-control radius-30 ps-5 @error('name') is-invalid @enderror" id="inputName" placeholder="Enter Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="contact" class="form-label">Mobile Number</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-telephone-fill"></i></div>
                                    <input type="tel" class="form-control radius-30 ps-5 @error('contact') is-invalid @enderror" id="contact" placeholder="Mobile Number" name="contact" value="{{ old('contact') }}" required autocomplete="contact">
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-envelope"></i></div>
                                    <input type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" id="email" placeholder="Email Address (Optional)" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Enter Password</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute auth-middle translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" id="password" placeholder="Enter Password" name="password" value="{{ old('password') }}" required autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">I Agree to the Trems & Conditions</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary radius-30">Sign up</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
