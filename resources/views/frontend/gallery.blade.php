@extends('layouts.frontend')
@section('content')
    <!-- BANNER -->
    <div class="section banner-page" data-background="">
        <div class="content-wrap pos-relative">
            <div class="d-flex justify-content-center bd-highlight mb-3">
                <div class="title-page">গ্যালারি</div>
            </div>
            <div class="d-flex justify-content-center bd-highlight mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">হোম</a></li>
                        <li class="breadcrumb-item active" aria-current="page">গ্যালারি</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- OUR GALLERY -->
    <div class="section">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="row popup-gallery gutter-5">
                            @foreach ($galleries as $gallery)
                                <div class="col-xs-6 col-md-3">
                                    <div class="box-gallery">
                                        <a href="{{ asset('uploads/gallery/' . $gallery->image) }}">
                                            <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" alt="Gallery Image" class="img-fluid">
                                            <div class="project-info">
                                                <div class="project-icon">
                                                    <span class="fa fa-search-plus"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
