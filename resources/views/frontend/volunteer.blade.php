@extends('layouts.frontend')
@section('content')
    <div class="section">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                            <p style="font-size: 23px">স্বেচ্ছাসেবী হিসাবে যোগদানে আগ্রহ প্রকাশ করার জন্য আপনাকে ধন্যবাদ। নিচের ফরমটি সঠিক ভাবে পূরণ করুন।</p>
                        </div>
                        <div class="mb-3">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">নাম</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">মোবাইল নাম্বার</label>
                                            <input type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required>
                                            @error('contact')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">ইমেইল (ঐচ্ছিক)</label>
                                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">পাসওয়ার্ড</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="check" required>
                                            <label class="form-check-label" for="check">মৈত্রেয় এর সকল নিয়মনীতি মেনে চলবো</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">রেজিস্টার করুন</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="py-3">
                            <hr>
                            <p>ইত:পূর্বে সেচ্ছাসেবক হিসাবে রেজিস্ট্রেশন করে থাকলে লগইন করুন।</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">লগইন করুন</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
