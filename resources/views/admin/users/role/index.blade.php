@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Roles List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered dataTable text-center align-middle" id="roles">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Created On</th>
                                @if ($user->role == 1)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->role }}</td>
                                    <td>{{ $role->created_at->diffForHumans() }}</td>
                                    @if ($user->role == 1)
                                        <td>
                                            <button type="button" data-id="{{ $role->id }}" class="btn btn-primary btn-sm edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button type="button" data-id="{{ $role->id }}" class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($user->role == 1)
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-role"><i class="fa-solid fa-plus"></i> Add New Role</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="add-role" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-role-form">
                        @csrf
                        <label for="role">Role</label>
                        <input type="text" name="role" id="role" class="form-control">
                        <div class="invalid-feedback">Please enter a Role name.</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="edit-role" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-role-form">
                        @csrf
                        <input type="hidden" name="id" id="role-id">
                        <label for="role">Role</label>
                        <input type="text" name="role" id="role-value" class="form-control">
                        <div class="invalid-feedback">Please enter a Role name.</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#add-role-form').submit(function(e) {
                e.preventDefault();
                role = $('#role').val();
                if (role.length != 0) {
                    $.ajax({
                        url: '{{ route('role.add') }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            let data = JSON.parse(response);
                            if (data.status == 'success') {
                                $('#add-role').modal('hide');
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                });
                                window.location.reload();
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.message
                                });
                            }
                        }
                    });
                } else {
                    $('#role').addClass('is-invalid');
                }

            });
            //dalete role
            $('.delete').click(function() {
                let id = $(this).data('id');
                let url = '{{ route('role.delete', ':id') }}'
                url = url.replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This role will delete permanently!",
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

            //edit role
            $('.edit').click(function() {
                let id = $(this).data('id');
                let url = '{{ route('role.edit.data') }}';
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        $('#edit-role').modal('show');
                        $('#role-id').val(data.id);
                        $('#role-value').val(data.role);
                    }
                });
            });

            $('#edit-role-form').submit(function(e) {
                e.preventDefault();
                role = $('#role-value').val();
                if (role.length != 0) {
                    $.ajax({
                        url: '{{ route('role.edit') }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            let data = JSON.parse(response);
                            if (data.status == 'success') {
                                $('#edit-role').modal('hide');
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                });
                                window.location.reload();
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.message
                                });
                            }
                        }
                    });
                } else {
                    $('#role-value').addClass('is-invalid');
                }

            });
        });
    </script>
@endsection
