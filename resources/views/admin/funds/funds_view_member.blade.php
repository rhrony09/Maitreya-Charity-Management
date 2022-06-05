@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-2 text-start">
                            @if ($user->role <= 3)
                                <a href="{{ route('funds.add') }}" class="btn btn-primary btn-sm">Add Fund</a>
                            @endif
                        </div>
                        <div class="col-lg-8">
                            <h3 class="text-center">{{ $page_title }} | {{ $year }}</h3>
                        </div>
                        <div class="col-lg-2 d-flex">
                            @if ($user->funds->count() > 0)
                                <select class="form-select" id="selected_year">
                                    @foreach ($year_list as $data)
                                        <option value="{{ $data }}" @if ($data == $year) selected @endif>{{ $data }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row py-4">
                        <div class="col-lg-1 d-flex justify-content-center align-items-center">
                            <img src="{{ asset('uploads/users/' . $user->image) }}" class="img-preview rounded-circle" style="height: 80px; width: 80px" alt="{{ $user->name }}">
                        </div>
                        <div class="col-lg-11">
                            <h6 class="fs-5">Name: {{ $user->name }}</h6>
                            <p class="m-0">Type: {{ $user->type == 1 ? 'Regular Member' : 'Family Member' }}</p>
                            <p class="m-0">Phone: {{ $user->contact }}</p>
                            <p class="m-0">Last Payment: {{ $user->funds->count() > 0? $user->funds->sortBy('created_at')->last()->created_at->diffForHumans(): 'N/A' }}</p>
                        </div>
                    </div>
                    <table class="table table-bordered text-center align-middle" id="example1">
                        <thead>
                            <tr>
                                @foreach ($months as $month)
                                    <th>{{ $month->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @for ($i = 1; $i <= 12; $i++)
                                    <td>
                                        @if ($data = $user->funds->where('type', 1)->where('month', $i)->where('year', $year)->first())
                                            <button data-bs-toggle="modal" data-bs-target="#fund-modal" data-id="{{ $data->id }}" class="funds btn btn-sm p-0">{{ $data->amount }} TK</button>
                                        @else
                                            {{ date('Y') == $year ? (date('n') >= $i ? 0 : '-') : 0 }}
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="text-center">Donate in {{ $year }}: <span class="badge bg-info fs-6">{{ moneyFormatBD($user->funds->where('year', $year)->sum('amount')) }} TK</span></h6>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="text-center">Lifetime Donate: <span class="badge bg-success fs-6">{{ moneyFormatBD($user->funds->sum('amount')) }} TK</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="fund-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="fundModalLabel">Loading...</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Loading...
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
            $('#selected_year').on('change', function() {
                let year = $(this).val();
                let url = "{{ route('funds.view.member', $user->id) }}" + "?year=" + year;
                window.location = url;
            });
            $('.funds').click(function() {
                let id = $(this).data('id');
                let url = "{{ route('funds.view.details', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#fund-modal .modal-content').html(response);
                    }
                });
            });
        });
    </script>
@endsection
