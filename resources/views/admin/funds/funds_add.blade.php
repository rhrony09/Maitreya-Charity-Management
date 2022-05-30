@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Add Funds</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('funds.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                                    <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Recurring</option>
                                    <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>One Time</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-5">
                                <label for="member" class="form-label">Member</label>
                                <div id="data"></div>
                            </div>
                            <div class="col-lg-4">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TK</span>
                                    <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="month" class="form-label">For Month</label>
                                <select name="month" id="month" class="form-select @error('month') is-invalid @enderror">
                                    @foreach ($months as $month)
                                        <option value="{{ $month->id }}" {{ (old('month') == $month->id ? 'selected' : '' || $month->id == date('n')) ? 'selected' : '' }}>{{ $month->name }}</option>
                                    @endforeach
                                </select>
                                @error('month')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="year" class="form-label">For Year</label>
                                <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year" value="{{ old('year') ?? date('Y') }}">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-select">
                                    <option value="" disabled {{ old('payment_method') == '' ? 'selected' : '' }}>-- Select Payment Method --</option>
                                    @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}" {{ old('payment_method') == $payment_method->id ? 'selected' : '' }}>{{ $payment_method->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Fund</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            checkType();
            $('#type').on('change', function() {
                checkType();
            });

            function checkType() {
                let type = $('#type').val();
                let type_1 = '<select name="member" id="member" class="form-select @error('member') is-invalid @enderror"> <option value="" disabled {{ old('member') == '' ? 'selected' : '' }}>-- Select Member --</option> @foreach ($members as $member) <option value="{{ $member->id }}" {{ old('member') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option> @endforeach </select> @error('member') <div class="invalid-feedback">{{ $message }}</div> @enderror';
                let type_2 = '<input type="text" class="form-control @error('member') is-invalid @enderror" name="member" id="member" value="{{ old('member') }}"> @error('member') <div class = "invalid-feedback"> {{ $message }} </div> @enderror';
                if (type == 1) {
                    $('#data').html(type_1);
                } else {
                    $('#data').html(type_2);
                }
            }
        });
    </script>
@endsection
