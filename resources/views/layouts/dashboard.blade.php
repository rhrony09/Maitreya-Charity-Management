<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- facebook meta tag -->
    <meta property="og:title" content="{{ App\Models\Setting::where('type', 'title')->get()->first()->name }} | {{ App\Models\Setting::where('type', 'tagline')->get()->first()->name }}">
    <meta property="og:description" content="মৈত্রেয় মূলত গাইবান্ধা জেলার এস.এস.সি-১৩ ব্যাচের শিক্ষার্থীদের গড়ে তোলা একটি সংগঠন। ২০২০ সাল থেকে এই সংগঠনের সদস্যরা নানা ধরণের সেবামূলক কাজ করে আসছে।">
    <meta property="og:image" content="{{ asset('uploads/images/maitreya-og.jpg') }}">

    <link rel="icon" href="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'favicon')->get()->first()->name) }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />
    <!--Theme Styles-->
    <link href="{{ asset('assets/backend/css/semi-dark.css') }}" rel="stylesheet" />
    <!-- Fontawsome 6 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/fontawsome-6.css') }}" />

    <title>{{ App\Models\Setting::where('type', 'title')->get()->first()->name }} | {{ App\Models\Setting::where('type', 'tagline')->get()->first()->name }}</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3">
                    <i class="bi bi-list"></i>
                </div>
                <form class="searchbar">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
                    <input class="form-control" type="text" placeholder="Type here to search">
                    <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
                </form>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item search-toggle-icon">
                            <a class="nav-link" href="#">
                                <div class="">
                                    <i class="bi bi-search"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <div class="user-setting d-flex align-items-center">
                                    <img src="{{ asset('uploads/users/' . Auth::user()->image) }}" class="user-img" alt="">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.profile') }}">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('uploads/users/' . Auth::user()->image) }}" alt="" class="rounded-circle" width="54" height="54">
                                            <div class="ms-3">
                                                <h6 class="mb-0 dropdown-user-name">{{ Auth::user()->name }}</h6>
                                                <small class="mb-0 dropdown-user-designation text-secondary">{{ Auth::user()->roles->role }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.profile') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-person-fill"></i></div>
                                            <div class="ms-3"><span>Profile</span></div>
                                        </div>
                                    </a>
                                </li>
                                @if (Auth::user()->role <= 2)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('settings') }}">
                                            <div class="d-flex align-items-center">
                                                <div class=""><i class="bi bi-gear-fill"></i></div>
                                                <div class="ms-3"><span>Setting</span></div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-lock-fill"></i></div>
                                            <div class="ms-3"><span>Logout</span></div>
                                        </div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link" href="{{ route('index') }}" target="_blank" title="Visit Website">
                                <div class="projects">
                                    <i class="fa-solid fa-earth-americas"></i>
                                </div>
                            </a>
                        </li>
                        @if (Auth::user()->role <= 3)
                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                    <div class="messages">
                                        @if (App\Models\Contact::where('status', 1)->count() > 0)
                                            <span class="notify-badge">{{ App\Models\Contact::where('status', 1)->count() }}</span>
                                        @endif
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-0">
                                    <div class="p-2 border-bottom m-2">
                                        <h5 class="h5 mb-0">Messages</h5>
                                    </div>
                                    <div class="header-message-list p-2">
                                        @forelse (App\Models\Contact::where('status', 1)->latest()->get() as $message)
                                            <a class="dropdown-item" href="{{ route('site.messages.view', $message->id) }}">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('uploads/users/default.jpg') }}" alt="" class="rounded-circle" width="50" height="50">
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="mb-0 dropdown-msg-user">{{ $message->name }} <span class="msg-time float-end text-secondary">{{ $message->created_at->diffForHumans() }}</span></h6>
                                                        <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">{{ \Illuminate\Support\Str::of($message->message)->limit(30, '...') }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                            <p class="text-center py-5">No Unread Message Found</p>
                                        @endforelse
                                    </div>
                                    <div class="p-2">
                                        <div>
                                            <hr class="dropdown-divider">
                                        </div>
                                        <a class="dropdown-item" href="{{ route('site.messages') }}">
                                            <div class="text-center">View All Messages</div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'logo')->get()->first()->name) }}" class="logo-icon logo-text" alt="logo">
                </div>
                <div class="icon">
                    <img src="{{ asset('uploads/logo/' .App\Models\Setting::where('type', 'favicon')->get()->first()->name) }}" alt="">
                </div>
                <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('home') }}">
                        <div class="parent-icon"><i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li class="menu-label">Overview</li>
                <li>
                    <a href="{{ route('funds.view.personal') }}">
                        <div class="parent-icon"><i class="bi bi-people-fill"></i>
                        </div>
                        <div class="menu-title">My Funds</div>
                    </a>
                </li>
                @if (Auth::user()->role <= 3)
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-cash-coin"></i>
                            </div>
                            <div class="menu-title">Accounts</div>
                        </a>
                        <ul>
                            <li> <a href="{{ route('funds') }}"><i class="bi bi-circle"></i>Funds</a></li>
                            <li> <a href="{{ route('expense') }}"><i class="bi bi-circle"></i>Expenses</a></li>
                        </ul>
                    </li>
                    <li class="menu-label">Frontend</li>
                    <li>
                        <a href="{{ route('site.banner') }}">
                            <div class="parent-icon"><i class="bi bi-card-image"></i>
                            </div>
                            <div class="menu-title">Banner</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.gallery') }}">
                            <div class="parent-icon"><i class="bi bi-columns-gap"></i>
                            </div>
                            <div class="menu-title">Gallery</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.messages') }}">
                            <div class="parent-icon"><i class="bi bi-chat-left"></i>
                            </div>
                            <div class="menu-title">Messages @if (App\Models\Contact::where('status', 1)->count() > 0)
                                    <span class="badge bg-danger rounded-pill">{{ App\Models\Contact::where('status', 1)->count() }}</span>
                                @endif
                            </div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role <= 2)
                    <li class="menu-label">Admin Area</li>
                    <li>
                        <a href="{{ route('users') }}">
                            <div class="parent-icon"><i class="bi bi-people-fill"></i>
                            </div>
                            <div class="menu-title">Members</div>
                        </a>
                    </li>
                    @if (Auth::user()->role == 1)
                        <li>
                            <a href="{{ route('role') }}">
                                <div class="parent-icon"><i class="bi bi-bar-chart-steps"></i>
                                </div>
                                <div class="menu-title">Roles</div>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('settings') }}">
                            <div class="parent-icon"><i class="bi bi-gear-fill"></i>
                            </div>
                            <div class="menu-title">Settings</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.logs') }}">
                            <div class="parent-icon"><i class="bi bi-list-check"></i>
                            </div>
                            <div class="menu-title">Logs</div>
                        </a>
                    </li>
                @endif
            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">
            <!--Strat breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page_title ?? 'Page' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--End breadcrumb-->
            @yield('content')
        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/backend/js/table-datatable.js') }}"></script>
    <!--app-->
    <script src="{{ asset('assets/backend/js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        new PerfectScrollbar(".best-product")
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        @endif
        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            })
        @endif
        @if (session('warning'))
            Toast.fire({
                icon: 'warning',
                title: '{{ session('warning') }}'
            })
        @endif
    </script>
    @yield('script')

</body>

</html>
