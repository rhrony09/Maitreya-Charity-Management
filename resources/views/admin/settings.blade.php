@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Site Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="title" class="form-label">Site Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ old('title') ?? $settings->title }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="tagline" class="form-label">Tagline</label>
                                <input type="text" class="form-control {{ $errors->has('tagline') ? 'is-invalid' : '' }}" id="tagline" name="tagline" value="{{ old('tagline') ?? $settings->tagline }}">
                                @error('tagline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="contact" class="form-label">Contact No</label>
                                <input type="tel" class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" id="contact" name="contact" value="{{ old('contact') ?? $settings->contact }}">
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') ?? $settings->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <img src="{{ asset('uploads/logo/' . $settings->logo) }}" id="logo" class="logo-preview bg-secondary p-2 mb-2" alt="Favicon">
                                <label class="form-label">Site Logo (White)</label>
                                <input type="file" class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" name="logo" onchange="document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])" accept="Image/png">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('uploads/logo/' . $settings->logo_black) }}" id="logo_black" class="logo-preview p-2 mb-2" alt="Favicon">
                                <label class="form-label">Site Logo (Black)</label>
                                <input type="file" class="form-control {{ $errors->has('logo_black') ? 'is-invalid' : '' }}" name="logo_black" onchange="document.getElementById('logo_black').src = window.URL.createObjectURL(this.files[0])" accept="Image/png">
                                @error('logo_black')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('uploads/logo/' . $settings->favicon) }}" id="icon" class="favicon-preview p-2 mb-2" alt="Favicon">
                                <label class="form-label">Favicon</label>
                                <input type="file" class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" name="favicon" onchange="document.getElementById('icon').src = window.URL.createObjectURL(this.files[0])" accept="image/png">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
