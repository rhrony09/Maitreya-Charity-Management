@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 pe-5">
                            <table class="table table-bordered text-center align-middle">
                                <tr>
                                    <th>Serial</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img style="width: 250px;" src="{{ asset('uploads/banner/' . $banner->image) }}" alt="Banner Image"></td>
                                        <td>
                                            <label class="switch">
                                                <input data-id="{{ $banner->id }}" class="status" type="checkbox" {{ $banner->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td><button data-id="{{ $banner->id }}" class="btn btn-danger btn-sm delete" {{ $banner->status == 1 ? 'disabled' : '' }}><i class="fa-solid fa-trash"></i></button></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">No Banner Found</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('site.banner.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="image" class="form-label">Banner Image</label>
                                    <img class="d-block" src="" id="preview-banner">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" accept="Image/JPEG,Image/PNG">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Add Banner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-banner').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                $('#preview-banner').css({
                    'width': '250px',
                    'height': '117px',
                    'object-fit': 'cover',
                    'margin-bottom': '10px'
                });
            });

            $('.status').change(function() {
                let id = $(this).data('id');
                let url = "{{ route('site.banner.status', ':id') }}";
                url = url.replace(':id', id);
                window.location = url;
            });
        });

        $('.delete').click(function() {
            let id = $(this).attr('data-id');
            let url = '{{ route('site.banner.delete', ':id') }}'
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: "This banner will be deleted!",
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
    </script>
@endsection
