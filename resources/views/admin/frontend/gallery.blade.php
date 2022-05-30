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
                            @forelse ($galleries as $gallery)
                                <div class="gallery-image"><img src="{{ asset('uploads/gallery/' . $gallery->image) }}" class="img-fluid"><button data-id="{{ $gallery->id }}" class="shadow-lg btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></button></div>
                            @empty
                                <div class="text-center">No Gallery Image Found</div>
                            @endforelse
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('site.gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gallery Image</label>
                                    <div id="image_preview"></div>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" id="image" onchange="preview_image();" accept="Image/JPEG,Image/PNG" multiple>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Add Image</button>
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
        function preview_image() {
            // console.log('preview');
            let total_file = document.getElementById("image").files.length;
            let images = '';
            for (var i = 0; i < total_file; i++) {
                images += '<img src="' + URL.createObjectURL(event.target.files[i]) + '" class="img-thumbnail" style="width: 100px; height: 67px; object-fit: cover;"/>';
            }
            $('#image_preview').html(images);
            $('#image_preview').css({
                'margin-bottom': '10px'
            });
        }

        $(document).ready(function() {
            $('.delete').click(function() {
                let id = $(this).attr('data-id');
                let url = '{{ route('site.gallery.delete', ':id') }}'
                url = url.replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This image will be deleted!",
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
@endsection
