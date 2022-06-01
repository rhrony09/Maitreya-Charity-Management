@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-flex justify-content-center">
                        <img src="{{ asset('uploads/images/oppssss.png') }}" class="inactive-banner" alt="Opppsssss.">
                    </div>
                    <div class="col-lg-6 px-5">
                        <h2 class="text-center fs-1 fw-bolder mb-4"><big>Oppsssss...</big></h2>
                        <h4 class="text-center mb-3">Your account is currently Inactive.</h4>
                        <p class="text-center">
                            Please wait for the confirmation from Team Maitreya.<br>We will let you know soon (by sms).
                        </p>
                        <div class="row my-5">
                            <div class="col-lg-6">
                                <h6>Contact No:</h6>
                                <p class="m-0"><a class="text-secondary" href="tel:+8801680710175">01680 710175</a></p>
                                <p class="m-0"><a class="text-secondary" href="tel:+8801719590659">01719 590659</a></p>
                                <p class="m-0"><a class="text-secondary" href="tel:+8801766379827">01766 379827</a></p>
                            </div>
                            <div class="col-lg-6">
                                <h6>Email:</h6>
                                <p class="m-0"><a class="text-secondary" href="mailto:info@maitreyabd.org">info@maitreyabd.org</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
