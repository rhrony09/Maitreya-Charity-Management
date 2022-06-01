<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ App\Models\Setting::where('type', 'title')->get()->first()->name }} | {{ App\Models\Setting::where('type', 'tagline')->get()->first()->name }}</title>
    <!-- facebook meta tag -->
    <meta property="og:title" content="{{ App\Models\Setting::where('type', 'title')->get()->first()->name }} | {{ App\Models\Setting::where('type', 'tagline')->get()->first()->name }}">
    <meta property="og:description" content="মৈত্রেয় মূলত গাইবান্ধা জেলার এস.এস.সি-১৩ ব্যাচের শিক্ষার্থীদের গড়ে তোলা একটি সংগঠন। ২০২০ সাল থেকে এই সংগঠনের সদস্যরা নানা ধরণের সেবামূলক কাজ করে আসছে।">
    <meta property="og:image" content="{{ asset('uploads/images/maitreya-og.jpg') }}">
    <meta name="author" content="RH Rony">

    <!-- ==============================================
 Favicons
 =============================================== -->
    <link rel="shortcut icon" href="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'favicon')->get()->first()->name) }}">
    <link rel="apple-touch-icon" href="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'favicon')->get()->first()->name) }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'favicon')->get()->first()->name) }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'favicon')->get()->first()->name) }}">

    <!-- ==============================================
 CSS VENDOR
 =============================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/vendor/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/vendor/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/vendor/animate.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- ==============================================
 Custom Stylesheet
 =============================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}" />

    <style>
        .loader {
            background-image: url("{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'logo_black')->get()->first()->name) }}");
        }

    </style>

    <script src="{{ asset('assets/frontend/js/vendor/modernizr.min.js') }}"></script>

</head>

<body>

    <!-- LOAD PAGE -->
    <div class="animationload">
        <div class="loader"></div>
    </div>

    <!-- BACK TO TOP SECTION -->
    <a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

    <!-- HEADER -->
    <div class="header header-1">
        <!-- MIDDLE BAR -->
        <div class="middlebar">
            <div class="container">
                <div class="contact-info">
                    <!-- INFO 1 -->
                    <div class="box-icon-1">
                        <div class="icon">
                            <div class="fa fa-phone"></div>
                        </div>
                        <div class="body-content">
                            <div class="heading">মোবাইল:</div>
                            {{ App\Models\Setting::where('type', 'contact')->get()->first()->name }}
                        </div>
                    </div>
                    <!-- INFO 2 -->
                    <div class="box-icon-1">
                        <div class="icon">
                            <div class="fa fa-envelope-o"></div>
                        </div>
                        <div class="body-content">
                            <div class="heading">ইমেইল:</div>
                            {{ App\Models\Setting::where('type', 'email')->get()->first()->name }}
                        </div>
                    </div>
                    <!-- INFO 3 -->
                    <div class="box-act">
                        <a href="javascript:void(0);" class="btn btn-lg btn-primary donate">ডোনেট করুন</a>
                    </div>

                </div>
            </div>
        </div>

        <!-- NAVBAR SECTION -->
        <div class="navbar-main">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <img src="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'logo_black')->get()->first()->name) }}" alt="Logo" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index') }}">হোম</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gallery') }}">গ্যালারি</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index') }}#contact">যোগাযোগ</a>
                            </li>
                        </ul>
                    </div>
                </nav> <!-- -->
            </div>
        </div>
    </div>

    @yield('content')

    <!-- CTA -->
    <div class="section cta">
        <div class="content-wrap-20">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="cta-1">
                            <div class="body-text">
                                <h3>আপনার সহযোগিতাই পারে একটি অসহায় মুখে হাসি ফুটাতে</h3>
                            </div>
                            <div class="body-action">
                                <a href="javascript:void(0);" class="btn btn-secondary donate">ডোনেট করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <div class="footer">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="footer-item d-flex align-items-center flex-column">
                            <img src="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'logo')->get()->first()->name) }}" alt="logo bottom" class="logo-bottom" style="max-width: 150px">
                            <div class="spacer-30"></div>
                            <div class="sosmed-icon primary">
                                <a href="https://www.facebook.com/maitreyabd">ফেইসবুক</a>
                                <a>●</a>
                                <a href="{{ route('login') }}">লগইন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fcopy">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 text-center">
                        @php
                            $eng_number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
                            $ban_number = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
                        @endphp
                        <p class="ftex"><a href="{{ route('index') }}"><span class="color-primary">মৈত্রেয়</span></a> &copy; ২০২০-{{ str_replace($eng_number, $ban_number, date('Y')) }} | সর্বস্বত্ব সংরক্ষিত . <span class="powered">Powered by <a
                                    href="https://www.imbdagency.com"><span class="color-primary">IMBD Agency</span></a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donate Modal -->
    <div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="donateModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body py-0">


                    <div class="d-block main-content">
                        <div class="modal-dialog">
                            <div class="modal-content border-0">
                                <div class="row">
                                    <div class="col-lg-12 position-relative">
                                        <img src="{{ asset('uploads/images/modal-cover.jpg') }}" alt="Banner">
                                        <div class="py-3">
                                            <p>আমাদের ডোনেট করতে আগ্রহী হবার জন্য আপনাকে ধন্যবাদ। নিম্নোক্ত মোবাইল ব্যাংকিং গুলোর মাধ্যমে আমাদেরকে আপনার ডোনেশনের অর্থ পাঠাতে পারেন।</p>
                                            <p class="text-center h4">
                                                বিকাশ: 01680 710175 <a href="javascript:void(0)" class="color-primary scan-qr ml-2" data-id="1" title="স্ক্যান করুন"><i style="font-size: 16px" class="bi bi-qr-code-scan"></i></a><br>
                                                নগদ: 01719 590659<br>
                                                রকেট: 01766 37827 <a href="javascript:void(0)" class="color-primary scan-qr ml-2" data-id="2" title="স্ক্যান করুন"><i style="font-size: 16px" class="bi bi-qr-code-scan"></i></a>
                                            </p>
                                            <p class="text-center pt-4">মাসিক ডোনেশন পাঠাতে চাইলে এখনি <a class="color-primary" href="{{ route('volunteer') }}">রেজিস্ট্রেশন</a> করুন</p>
                                            <div class="text-center"><button class="btn py-1 px-3 btn-primary" data-dismiss="modal">বন্ধ করুন</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- QR Modal -->
    <div class="modal fade" id="QrModal" tabindex="-1" aria-labelledby="QrModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QrModal">স্ক্যান করুন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="badge badge-secondary qr-go-back"><i style="font-size: 16px" class="bi bi-arrow-bar-left"></i> পিছনে যান</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS VENDOR -->
    <script src="{{ asset('assets/frontend/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/jquery.magnific-popup.min.js') }}"></script>

    <!-- SENDMAIL -->
    <script src="{{ asset('assets/frontend/js/vendor/validator.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>

    <script>
        $('.donate').click(function() {
            $('#donateModal').modal('show');
        });

        $('.scan-qr').click(function() {
            let id = $(this).data('id');
            $('#donateModal').modal('hide');
            $('#QrModal').modal('show');
            if (id == 1) {
                $('#QrModal .modal-body').html('<img class="img-fluid" src="{{ asset('uploads/images/bkash-qr.jpg') }}" alt="qr-code">');
            } else if (id == 2) {
                $('#QrModal .modal-body').html('<img class="img-fluid" src="{{ asset('uploads/images/rocket-qr.jpg') }}" alt="qr-code">');
            }
        });

        $('.qr-go-back').click(function() {
            $('#QrModal').modal('hide');
            $('#donateModal').modal('show');
        });

        $("#contactForm").on("submit", function(event) {
            event.preventDefault();
            let name = $("#p_name").val();
            let email = $("#p_email").val();
            let phone = $("#p_phone").val();
            let subject = $("#p_subject").val();
            let message = $("#p_message").val();

            if (name == "" || email == "" || phone == "" || subject == "" || message == "") {
                formError();
            } else {
                let data = {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    email: email,
                    phone: phone,
                    subject: subject,
                    message: message
                };
                submitForm(data);
            }
        });

        function submitForm(data) {
            $.ajax({
                type: "POST",
                url: "{{ route('send.message') }}",
                data: data,
                success: function(response) {
                    formSuccess(response.success);
                }
            });
        }

        function formSuccess(response) {
            $("#contactForm")[0].reset();
            submitMSG(true, response)
        }

        function formError() {
            $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                $(this).removeClass();
            });
        }

        function submitMSG(valid, msg) {
            if (valid) {
                var msgClasses = "py-3 text-success";
            } else {
                var msgClasses = "pb-3 text-danger";
            }
            $("#success").removeClass().addClass(msgClasses).text(msg);
        }
    </script>

    @yield('script')

</body>

</html>
