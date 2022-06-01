@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card radius-10 bg-purple py-3 px-3">
                    <div class="card-body">
                        <h4 class="mb-0 text-white">Payment Methods</h4>
                        <div class="d-lg-flex pt-3 gap-5 text-light">
                            <div>
                                <h6 class="mb-1">Bkash: 01680-710175</h6>
                                <button class="btn btn-light btn-sm scan-qr" data-id="1"><img src="{{ asset('uploads/images/qr-scan.svg') }}" width="18px"> Scan QR</button>
                            </div>
                            <div>
                                <h6 class="mb-1">Nagad: 01719-590659</h6>
                            </div>
                            <div>
                                <h6 class="mb-1">Rocket: 01766-379827</h6>
                                <button class="btn btn-light btn-sm scan-qr" data-id="2"><img src="{{ asset('uploads/images/qr-scan.svg') }}" width="18px"> Scan QR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- QR Modal -->
    <div class="modal fade" id="QrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Scan QR</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.scan-qr').click(function() {
                let id = $(this).data('id');
                $('#QrModal').modal('show');
                if (id == 1) {
                    $('#QrModal .modal-body').html('<img class="img-fluid" src="{{ asset('uploads/images/bkash-qr.jpg') }}" alt="qr-code">');
                } else if (id == 2) {
                    $('#QrModal .modal-body').html('<img class="img-fluid" src="{{ asset('uploads/images/rocket-qr.jpg') }}" alt="qr-code">');
                }
            });
        });
    </script>
@endsection
