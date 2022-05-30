@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $page_title }}</h3>
                </div>
                <div class="card-body py-5">
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <strong>Name:</strong> {{ $message->name }}
                        </div>
                        <div class="col-lg-4">
                            <strong>Email:</strong> {{ $message->email }}
                        </div>
                        <div class="col-lg-4">
                            <strong>Mobile No:</strong> {{ $message->phone }}
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <strong>Subject:</strong> {{ $message->subject }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <strong class="d-block">Message:</strong>{{ $message->message }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('site.messages.delete', $message->id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
