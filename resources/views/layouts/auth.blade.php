<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- facebook meta tag -->
    <meta property="og:title" content="{{ $settings->title }} | {{ $settings->tagline }}">
    <meta property="og:description" content="মৈত্রেয় মূলত গাইবান্ধা জেলার এস.এস.সি-১৩ ব্যাচের শিক্ষার্থীদের গড়ে তোলা একটি সংগঠন। ২০২০ সাল থেকে এই সংগঠনের সদস্যরা নানা ধরণের সেবামূলক কাজ করে আসছে।">
    <meta property="og:image" content="{{ asset('uploads/images/maitreya-og.jpg') }}">

    <link rel="icon" href="{{ asset('uploads/logo/' . $settings->favicon) }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />

    <title>{{ $settings->title }} | {{ $settings->tagline }}</title>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    @yield('content')
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>


</body>

</html>
