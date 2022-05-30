@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('expense.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $expense->id }}">
                        <div class="row mb-3">
                            <div class="col-lg-9">
                                <label for="details" class="form-label">Details</label>
                                <input type="text" name="details" id="details" class="form-control @error('details') is-invalid @enderror" value="{{ old('details') ?? $expense->details }}">
                                @error('details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">TK</span>
                                    <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') ?? $expense->amount }}">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="member" class="form-label">Expense By</label>
                                <select name="member" id="member" class="form-select @error('member') is-invalid @enderror">
                                    <option value="" {{ old('member') == '' ? 'selected' : '' }} disabled>Select Member</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}" {{ old('member') == $member->id || $expense->user_id == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Edit Expense</button>
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
            //
        });
    </script>
@endsection
