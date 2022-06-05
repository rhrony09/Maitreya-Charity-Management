@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-0">User Account</h5>
                    <hr>
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">USER INFORMATION</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update.info') }}" method="POST" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="col-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} {{ $user->role <= $user->role && $user->role <= 2 ? '' : 'disabled' }}" value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} {{ $user->role <= $user->role && $user->role <= 2 ? '' : 'disabled' }}" value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Contact</label>
                                    <input type="tel" name="contact" class="form-control  {{ $errors->has('contact') ? 'is-invalid' : '' }} {{ $user->role <= $user->role && $user->role <= 2 ? '' : 'disabled' }}" value="{{ old('contact') ?? $user->contact }}">
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Role</label>
                                    @if ($user->role < $user->role && Auth::id() != $user->id)
                                        <select class="form-select" name="role">
                                            @foreach ($roles as $role)
                                                @if ($user->role < $role->id)
                                                    <option value="{{ $role->id }}" {{ old('role') == $role->id || $role->id == $user->role ? 'selected' : '' }}>{{ $role->role }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="role" class="form-control" value="{{ $user->role }}">
                                        <input type="text" class="form-control disabled" value="{{ $user->roles->role }}">
                                    @endif

                                </div>
                                <div class="col-6">
                                    <label class="form-label">Member Type</label>
                                    <select class="form-select {{ $user->role <= $user->role && $user->role <= 2 ? '' : 'disabled' }}" name="type">
                                        <option value="1" {{ $user->type == 1 ? 'selected' : '' }}>Regular Member</option>
                                        <option value="2" {{ $user->type == 2 ? 'selected' : '' }}>Family Member</option>
                                    </select>
                                </div>
                                <div class="text-start">
                                    @if ($user->role <= $user->role && $user->role <= 2)
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--change password-->
            @if ($user->role <= $user->role && $user->role <= 2)
                <div class="card shadow-none border">
                    <div class="card-header">
                        <h6 class="mb-0">Change Password</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update.password') }}" method="POST" class="row g-3">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="col-6">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter new password" value="{{ old('password') }}" required>
                                    <span class="input-group-text"><i id="password-show" class="fa-solid fa-eye"></i></span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm_password" class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Enter confirm password" value="{{ old('confirm_password') }}" required>
                                    <span class="input-group-text"><i id="confirm_password-show" class="fa-solid fa-eye"></i></span>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img id="profile-pic" src="{{ asset('uploads/users/' . $user->image) }}" class="rounded-circle shadow" width="120" height="120" alt="{{ $user->name }}">
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
                    @if ($user->role <= $user->role && $user->role <= 2)
                        <div class="mt-5">
                            <form action="{{ route('users.update.profile.picture') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
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
                    @endif
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
