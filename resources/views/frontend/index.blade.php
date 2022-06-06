@extends('layouts.frontend')
@section('content')
    <!-- BANNER -->
    <div id="oc-fullslider" class="banner d-block owl-carousel">
        @foreach ($banners as $banner)
            <div class="owl-slide">
                <div class="item">
                    <img src="{{ asset('uploads/banner/' . $banner->image) }}" alt="Slider">
                </div>
            </div>
        @endforeach
    </div>
    <div class="clearfix"></div>

    <!-- ABOUT US -->
    <div id="about" class="section section-border">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <h2 class="section-heading">
                            <span>মৈত্রেয়তে</span> আপনাকে স্বাগতম
                        </h2>
                        <p>মৈত্রেয় একটি অলাভজনক স্বেচ্ছাসেবসংঘটন। গাইবান্ধা জেলার এসএসসি ব্যাচ ২০১৩ এর উদ্যোগে একদল মহৎহৃদয় তরুণ-তরুণীর প্রচেষ্টায় ২০২০ সালে মৈত্রেয় প্রতিষ্ঠিত হয়। মানব কল্যাণ সাধনই মৈত্রেয় এর মূল লক্ষ্য।</p>

                        <p>করোনার প্রকোপে গাইবান্ধার হতদরিদ্র জনগুষ্ঠি যখন দুমুঠো অন্ন জোগাতে হিমশিম খাচ্ছিলো তখনি মৈত্রেয় তাদের জন্য সাহায্যের হাত বাড়িয়ে দেয়। করোনা আক্রান্ত্র হবার ঝুঁকি নিয়েও মৈত্রেয়ের স্বেচ্ছাসেবীরা নিত্যপ্রয়োজনীয় দ্রব্য পৌঁছে দিয়েছে তাদের দোরগোড়ায়।</p>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <img src="{{ asset('uploads/images/home-image-01-min.jpg') }}" alt="" class="img-fluid img-border">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HOW TO HELP US -->
    <div id="faq" class="section section-border">
        <div class="content-wrap">
            <div class="container">
                <div class="row">

                    <div class="col-sm-6 col-md-6">
                        <h2 class="section-heading">
                            কিভাবে আমাদের <span>সহযোগিতা</span> করবেন?
                        </h2>
                        <div class="margin-bottom-50"></div>
                        <dl class="hiw">
                            <dt><span class="fa fa-gift"></span></dt>
                            <dd>
                                <div class="no">01</div>
                                <h3>ডোনেশন প্রদান করুন</h3>
                            </dd>
                            <dt><span class="fa fa-male"></span></dt>
                            <dd>
                                <div class="no">02</div>
                                <h3>স্বেচ্ছাসেবক হিসাবে যোগ দিন
                            </dd>
                            <dt><span class="fa fa-users"></span></dt>
                            <dd>
                                <div class="no">03</div>
                                <h3>নতুন সদস্য সংগ্রহে সহায়তা করুন
                            </dd>
                            <dt><span class="fa fa-bullhorn"></span></dt>
                            <dd>
                                <div class="no">04</div>
                                <h3>সামাজিক যোগাযোগ মাধ্যমে ছড়িয়ে দিন</h3>
                            </dd>

                        </dl>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <h2 class="section-heading">
                            সাধারন <span>জিজ্ঞাসা</span>
                        </h2>
                        <div class="margin-bottom-50"></div>
                        <div class="accordion rs-accordion" id="accordionExample">
                            <!-- Item 1 -->
                            <div class="card mb-2">
                                <div class="card-header" id="headingOne">
                                    <h4 class="title">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            কি ভাবে ডোনেশন পাঠাবো?
                                        </button>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="m-0">মোবাইল ব্যাংকিং, ব্যাংক অথবা সরাসরি সাক্ষাৎ করেও আমাদের কে ডোনেশনের অর্থ প্রেরণ করতে পারেন।</p>
                                        <p class="m-0">মোবাইল ব্যাংকিং নম্বর সমূহ:</p>
                                        <p class="m-0">বিকাশ: ০১৬৮০ ৭১০১৭৫</p>
                                        <p class="m-0">নগদ: ০১৭১৯ ৫৯০৬৫৯</p>
                                        <p class="m-0">রকেট: ০১৭৬৬ ৩৭৮২৭</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="card mb-2">
                                <div class="card-header" id="headingTwo">
                                    <h4 class="title">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            ডোনেশনের টাকা দিয়ে আমরা কি করি?
                                        </button>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        অসহায় ব্যাক্তিদের সাহায্য প্রদান করা, নিত্যপ্রয়োজনীয় দ্রব্য বিতরণ, বৃদ্ধাশ্রম ও এতিমখানার খাবারের দায়িত্ব গ্রহণ, কুরবানির ব্যবস্থা এবং বৃক্ষ রোপন সহ অন্যান্য সামাজিক উন্নয়ন মূলক কাজে আপনার দেওয়া ডোনেশনের টাকা ব্যায় করা হয়।
                                    </div>
                                </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="card mb-2">
                                <div class="card-header" id="headingThree">
                                    <h4 class="title">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            কি ভাবে স্বেচ্ছাসেবক সদস্য হবো?
                                        </button>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>সেচ্ছাসেবক হিসাবে যোগ দিতে চাইলে নিচের লিংকে ক্লিক করে ফর্মটি পূরণ করুন। সঠিক ভাবে ফ্রম পূরণ করা হলে আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করে আপনাকে সেচ্ছাসেবক হিসাবে আমাদের সাথে যুক্ত করবে।</p>
                                        <p class="m-0"><a href="{{ route('volunteer') }}" class="color-primary">সেচ্ছাসেবক হতে এখানে ক্লিক করুন</a></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 4 -->
                            <div class="card mb-2">
                                <div class="card-header" id="headingFour">
                                    <h4 class="title">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            স্বেচ্ছাসেবক সদস্য হবার পর করণীয় কি?
                                        </button>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        সেচ্ছাসেবক হলে আমাদের সাথে বিভিন্ন উন্নয়নমূলক কাজে অংশ গ্রহণ করতে হবে। সম্ভব হলে নতুন সদস্য সংগ্রহ এবং অন্যদের ডোনেশন প্রদানে আগ্রহী করে তুলতে হবে। সর্বোপরি প্রতিমাসে সর্বনিম্ন ১০০ টাকা হরে নিজে ডোনেশন প্রদান করতে আগ্রহী থাকতে হবে।
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Become a Volunteer -->
    <div class="section" data-background="{{ asset('uploads/images/background/bg-map-dot.jpg') }}">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="cta-info color-white">
                            <h1 class="section-heading light no-after">
                                <span>স্বেচ্ছাসেবক</span> হতে আগ্রহী?
                            </h1>

                            <div class="spacer-10"></div>
                            <p>সমাজের একজন সচেতন নাগরিক হিসাবে অসহায় ব্যাক্তিদের প্রতি সাহায্যের হাত বাড়িয়ে দাওয়া আমাদের দায়িত্ব ও কর্তব্য। আজই আমাদের সাথে স্বেচ্ছাসেবক হিসাবে যোগ দিন।</p>

                            <a href="{{ route('volunteer') }}" class="btn btn-primary margin-btn">এখনই যোগ দিন</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- OUR GALLERY -->
    <div class="section" data-background="{{ asset('uploads/images/background/gallery-bg-min.jpg') }}">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2 class="section-heading center">
                            ফটো <span>গ্যালারি</span>
                        </h2>
                    </div>
                    <div class="row popup-gallery gutter-5">
                        @foreach ($galleries as $gallery)
                            <div class="col-xs-12 col-md-4">
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
                <p class="text-center my-4"><a href="{{ route('gallery') }}">আরও দেখুন</a></p>
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <div id="contact" class="section">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-8 pr-5">
                        <h2 class="section-heading">
                            <span>মেসেজ</span> করুন
                        </h2>
                        <div class="content">
                            <form action="#" class="form-contact" id="contactForm" data-toggle="validator" novalidate="true">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="p_name" placeholder="নাম">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="p_email" placeholder="ইমেইল">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="p_subject" placeholder="বিষয়">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="p_phone" placeholder="মোবাইল নং">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea id="p_message" class="form-control" rows="4" placeholder="মেসেজ"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-primary">প্রেরণ করুন</button>
                                </div>
                            </form>
                            <div class="margin-bottom-50"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <h2 class="section-heading">
                            <span>যোগাযোগের</span> মাধ্যম
                        </h2>
                        <div class="rs-icon-info">
                            <div class="info-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="info-text">{{ App\Models\Setting::where('type', 'contact')->get()->first()->name }}</div>
                        </div>
                        <div class="rs-icon-info">
                            <div class="info-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="info-text">{{ App\Models\Setting::where('type', 'email')->get()->first()->name }}</div>
                        </div>
                        <div class="rs-icon-info">
                            <div class="info-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="info-text">গাইবান্ধা সদর, গাইবান্ধা, বাংলাদেশ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
