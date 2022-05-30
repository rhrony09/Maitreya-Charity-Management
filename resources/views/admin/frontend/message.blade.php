@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $page_title }} ({{ $messages->count() }})</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="emails">
                                @forelse ($messages as $message)
                                    <a class="{{ $message->status == 1 ? 'text-dark' : 'text-secondary' }}" href="{{ route('site.messages.view', $message->id) }}">
                                        <div class="d-md-flex align-items-center px-3 py-2">
                                            <div class="d-flex align-items-center email-actions">
                                                <p class="mb-0 {{ $message->status == 1 ? 'fw-bold' : '' }}">{{ $message->name }}</p>
                                            </div>
                                            <div class="">
                                                <p class="mb-0">{{ \Illuminate\Support\Str::of($message->message)->limit(90, '...') }}</p>
                                            </div>
                                            <div class="ms-auto">
                                                <p class="mb-0 email-time">{{ $message->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="d-md-flex align-items-center justify-content-center px-3 py-5">
                                        <p class="mb-0">No Message Found</p>
                                    </div>
                                @endforelse
                            </div>
                            <div class="mt-3">{{ $messages->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
