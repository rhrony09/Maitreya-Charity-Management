@extends('layouts.auth')

@section('content')
    <div class="card shadow rounded-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                <img src="{{ asset('assets/backend/images/error/forgot-password-frent-img.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">Forgot Password?</h5>
                    <p class="card-text mb-5">Enter your registered email ID to reset the password</p>
                    <form class="form-body" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputEmailid" class="form-label">Email ID</label>
                                <input type="email" class="form-control form-control-lg radius-30 @error('email') is-invalid @enderror" id="inputEmailid" placeholder="Email ID" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                                    <a href="{{ route('login') }}" class="btn btn-lg btn-light radius-30">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
