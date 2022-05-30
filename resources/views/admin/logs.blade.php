@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center align-middle" id="example">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Details</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td>{{ $loop->remaining + 1 }}</td>
                                    <td>{{ $log->details }}</td>
                                    <td>{{ $log->type }}</td>
                                    <td>{{ $log->status }}</td>
                                    <td>{{ $log->created_at->diffForHumans() }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10">No Log Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
