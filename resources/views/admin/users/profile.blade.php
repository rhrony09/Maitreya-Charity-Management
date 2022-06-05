@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">USER INFORMATION</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update.info') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Contact No</label>
                                    <input type="tel" name="contact" class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" value="{{ old('contact') ?? $user->contact }}">
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">CHANGE PASSWORD</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update.info') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter new password" value="{{ old('password') }}">
                                        <span class="input-group-text"><i id="password-show" class="fa-solid fa-eye"></i></span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Enter confirm password" value="{{ old('confirm_password') }}">
                                        <span class="input-group-text"><i id="confirm_password-show" class="fa-solid fa-eye"></i></span>
                                        @error('confirm_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img id="profile-pic" src="{{ asset('uploads/users/' . $user->image) }}" class="rounded-circle shadow" alt="{{ $user->name }}">
                    </div>
                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="mb-0 text-secondary">{{ $user->roles->role }}</p>
                        <p class="mb-0 text-secondary">Contact No: {{ $user->contact }}</p>
                        @if ($user->email)
                            <p class="mb-0 text-secondary">Email: {{ $user->email }}</p>
                        @endif
                        <div class="mt-4"></div>
                    </div>
                    <div class="mt-5">
                        <form action="{{ route('profile.update.profile.picture') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Picture</label>
                                <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" onchange="document.getElementById('profile-pic').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg, image/png">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#password-show').click(function() {
                if ($('#password').attr('type') == 'password') {
                    $('#password').attr('type', 'text');
                    $('#password-show').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $('#password').attr('type', 'password');
                    $('#password-show').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
            $('#confirm_password-show').click(function() {
                if ($('#confirm_password').attr('type') == 'password') {
                    $('#confirm_password').attr('type', 'text');
                    $('#confirm_password-show').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $('#confirm_password').attr('type', 'password');
                    $('#confirm_password-show').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endsection
