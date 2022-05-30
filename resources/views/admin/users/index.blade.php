@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <h3 class="text-center">{{ $page_title }} ({{ count($users) }})</h3>
                    </div>
                    <div class="col-lg-2 d-flex align-items-center">
                        <span class="me-2">Filter:</span>
                        <select class="form-select" id="filter">
                            <option value="active" @if ($status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($status == 'inactive') selected @endif>Inactive</option>
                            <option value="all" @if ($status == 'all' || $status == '') selected @endif>All</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center align-middle" id="example">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Join On</th>
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
                                    <td>
                                        <select data-id="{{ $user->id }}" name="role" class="form-select role" {{ Auth::user()->role <= $user->role && Auth::user()->role <= 2 && Auth::id() != $user->id ? '' : 'disabled' }}>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{ $role->id == $user->role ? 'selected' : '' }} {{ Auth::user()->role >= $role->id ? 'disabled' : '' }}>{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $user->type == 1 ? 'Regular Member' : 'Family Member' }}</td>
                                    <td>
                                        <select data-id="{{ $user->id }}" name="status" class="form-select status" {{ $user->id != Auth::id() && Auth::user()->role <= 2 ? '' : 'disabled' }}>
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    @if (Auth::user()->role <= 3)
                                        <td>
                                            <a href="{{ route('users.view', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
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
                        <a href="{{ route('users.trashed') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i> Trashed Users</a>
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
                $('#filter').on('change', function() {
                    let filter = $(this).val();
                    let url = "{{ route('users') }}" + "?status=" + filter;
                    window.location = url;
                });

                $('.role').on('change', function() {
                    let id = $(this).data('id');
                    let role = $(this).val();
                    $.ajax({
                        url: "{{ route('users.update.role') }}",
                        method: "POST",
                        data: {
                            id: id,
                            role: role,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.message
                                });
                            }
                        }
                    });
                });

                $('.status').on('change', function() {
                    let id = $(this).data('id');
                    let status = $(this).val();
                    $.ajax({
                        url: "{{ route('users.update.status') }}",
                        method: "POST",
                        data: {
                            id: id,
                            status: status,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.message
                                });
                            }
                        }
                    });
                });

                $('.delete').click(function() {
                    let id = $(this).attr('data-id');
                    let url = '{{ route('users.delete', ':id') }}'
                    url = url.replace(':id', id);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This user will be deleted!",
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
