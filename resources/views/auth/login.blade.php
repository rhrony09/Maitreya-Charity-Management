@extends('layouts.auth')

@section('content')
    <div class="card shadow rounded-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/backend/images/error/login-img.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                    <h4 class="card-title">Login</h4>
                    <form class="form-body" method="POST" action="{{ route('login') }}">
                        @csrf
                        <hr>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="contact" class="form-label">Mobile Number</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute translate-middle-y search-icon auth-middle px-3"><i class="bi bi-telephone-fill"></i></div>
                                    <input type="tel" class="form-control radius-30 ps-5 @error('contact') is-invalid @enderror" id="contact" placeholder="Mobile No" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute translate-middle-y auth-middle search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" id="inputChoosePassword" placeholder="Enter Password" name="password" value="{{ old('password') }}" required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="remember" {{ old('remember') ? 'checked' : '' }} checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary radius-30">Login</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
