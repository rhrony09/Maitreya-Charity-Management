@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="card radius-10 bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center py-3 px-3">
                            <div class="">
                                <p class="mb-1 text-white">Total Outstanding</p>
                                <h4 class="mb-0 text-white">{{ moneyFormatBD($funds->sum('amount') - $expenses->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-white-1 text-white" style="width: 65px; height: 65px">
                                <i class="fs-4 fa-solid fa-sack-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card radius-10 bg-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center py-3 px-3">
                            <div class="">
                                <p class="mb-1 text-white">Total Fund Received</p>
                                <h4 class="mb-0 text-white">{{ moneyFormatBD($funds->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-white-1 text-white" style="width: 65px; height: 65px">
                                <i class="fs-4 fa-solid fa-circle-dollar-to-slot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card radius-10 bg-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center py-3 px-3">
                            <div class="">
                                <p class="mb-1 text-white">Total Expense</p>
                                <h4 class="mb-0 text-white">{{ moneyFormatBD($expenses->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-white-1 text-white" style="width: 65px; height: 65px">
                                <i class="fs-4 fa-solid fa-money-bill-transfer"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-3 mb-2">Funds Received</h4>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Month</p>
                                <h4 class="mb-0 text-success">{{ moneyFormatBD(App\Models\Funds::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Month</p>
                                <h4 class="mb-0 text-success">{{ moneyFormatBD(App\Models\Funds::whereMonth('created_at', date('m') - 1)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Year</p>
                                <h4 class="mb-0 text-success">{{ moneyFormatBD(App\Models\Funds::whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Year</p>
                                <h4 class="mb-0 text-success">{{ moneyFormatBD(App\Models\Funds::whereYear('created_at', date('Y') - 1)->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-3 mb-2">Expenses</h4>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-danger border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Month</p>
                                <h4 class="mb-0 text-danger">{{ moneyFormatBD(App\Models\Expense::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-danger text-white">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-danger border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Month</p>
                                <h4 class="mb-0 text-danger">{{ moneyFormatBD(App\Models\Expense::whereMonth('created_at', date('m') - 1)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-danger text-white">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-danger border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Year</p>
                                <h4 class="mb-0 text-danger">{{ moneyFormatBD(App\Models\Expense::whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-danger text-white">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-danger border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Year</p>
                                <h4 class="mb-0 text-danger">{{ moneyFormatBD(App\Models\Expense::whereYear('created_at', date('Y') - 1)->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-danger text-white">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-3 mb-2">Funds Received via bKash</h4>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-pink border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Month</p>
                                <h4 class="mb-0 text-pink">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 1)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-pink text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/bkash-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-pink border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Month</p>
                                <h4 class="mb-0 text-pink">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 1)->whereMonth('created_at', date('m') - 1)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-pink text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/bkash-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-pink border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Year</p>
                                <h4 class="mb-0 text-pink">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 1)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-pink text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/bkash-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-pink border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Lifetime</p>
                                <h4 class="mb-0 text-pink">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 1)->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-pink text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/bkash-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-3 mb-2">Funds Received via Rocket</h4>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-purple border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Month</p>
                                <h4 class="mb-0 text-purple">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 2)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-purple text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/rocket-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-purple border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Month</p>
                                <h4 class="mb-0 text-purple">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 2)->whereMonth('created_at', date('m') - 1)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-purple text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/rocket-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-purple border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Year</p>
                                <h4 class="mb-0 text-purple">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 2)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-purple text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/rocket-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-purple border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Lifetime</p>
                                <h4 class="mb-0 text-purple">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 2)->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-purple text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/rocket-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-3 mb-2">Funds Received via Nagad</h4>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-orange border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Month</p>
                                <h4 class="mb-0 text-orange">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 3)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-orange text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/nagad-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-orange border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Last Month</p>
                                <h4 class="mb-0 text-orange">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 3)->whereMonth('created_at', date('m') - 1)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-orange text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/nagad-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-orange border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">This Year</p>
                                <h4 class="mb-0 text-orange">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 3)->whereYear('created_at', date('Y'))->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-orange text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/nagad-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3">
                <div class="card radius-10 border-0 border-start border-orange border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Lifetime</p>
                                <h4 class="mb-0 text-orange">{{ moneyFormatBD(App\Models\Funds::where('payment_method', 3)->sum('amount')) }} TK</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-orange text-white">
                                {{-- <i class="fa-solid fa-money-bill-transfer"></i> --}}
                                <img src="{{ asset('assets/backend/images/icons/nagad-logo.svg') }}" alt="bkash">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
