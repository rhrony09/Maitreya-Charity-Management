@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Deleted Users ({{ count($users) }})</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center align-middle" id="example">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Delete On</th>
                                @if (Auth::user()->role <= 3)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="profile-pic" src="{{ asset('uploads/users/' . $user->image) }}" alt="{{ $user->name }}"></td>
                                    <td>{{ $user->name }} @if ($user->id == Auth::id())
                                            <span class="badge rounded-pill bg-secondary fw-normal">It's you</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ $user->roles->role }}</td>
                                    <td>{{ $user->type == 1 ? 'Regular Member' : 'Family Member' }}</td>
                                    <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $user->deleted_at->diffForHumans() }}</td>
                                    @if (Auth::user()->role <= 3)
                                        <td>
                                            <a href="{{ route('users.restore', $user->id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i></a>
                                            @if (Auth::user()->role <= $user->role && $user->id != Auth::id())
                                                <button data-id="{{ $user->id }}" class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if (Auth::user()->role <= 3)
                    <div class="card-footer">
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-user-plus"></i> Add User</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (Auth::user()->role <= 3)
        <script>
            $(document).ready(function() {
                $('.delete').click(function() {
                    let id = $(this).attr('data-id');
                    let url = '{{ route('users.delete.permanent', ':id') }}'
                    url = url.replace(':id', id);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This user will be deleted permanently!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = url;
                        }
                    })
                });
            });
        </script>
    @endif
@endsection
