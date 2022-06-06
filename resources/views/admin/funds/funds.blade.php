@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 text-start">
                            @if (Auth::user()->role <= 3)
                                <a href="{{ route('funds.add') }}" class="btn btn-primary btn-sm">Add Fund</a>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <h3 class="text-center">Recurring Funds of {{ $year }}</h3>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <span class="me-2">Filter:</span>
                            <select class="form-select" id="selected_year">
                                @foreach ($year_list as $data)
                                    <option value="{{ $data }}" @if ($data == $year) selected @endif>{{ $data }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('funds.list') }}" class="btn ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="List View"><i class="fa-solid fa-list-ul"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center align-middle nowrap" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th style="min-width: 280px">Member</th>
                                @foreach ($months as $month)
                                    <th>{{ $month->name }}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start">
                                        <div class="chip m-0">
                                            <img src="{{ asset('uploads/users/' . $member->image) }}" alt="Contact Person">{{ $member->name }}
                                        </div>
                                    </td>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td>
                                            @if ($data = $member->funds->where('type', 1)->where('month', $i)->where('year', $year)->first())
                                                <button data-bs-toggle="modal" data-bs-target="#fund-modal" data-id="{{ $data->id }}" class="funds btn btn-sm p-0">{{ $data->amount }} TK</button>
                                            @else
                                                {{ date('Y') == $year ? (date('n') >= $i ? 0 : '-') : 0 }}
                                            @endif
                                        </td>
                                    @endfor
                                    <td><a href="{{ route('funds.view.member', $member->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa-solid fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                @for ($i = 1; $i <= 12; $i++)
                                    <td>{{ moneyFormatBD(App\Models\Funds::where('type', 1)->where('year', $year)->where('month', $i)->sum('amount')) }} TK</td>
                                @endfor
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <h6>Total Recurring in {{ $year }}: <span class="badge bg-info fs-6">{{ moneyFormatBD(App\Models\Funds::where('year', $year)->where('type', 1)->sum('amount')) }} TK</span></h6>
                        </div>
                        <div class="col-lg-3">
                            <h6>Lifetime Recurring: <span class="badge bg-success fs-6">{{ moneyFormatBD(App\Models\Funds::where('type', 1)->sum('amount')) }} TK</span></h6>
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
                    <h5 class="modal-title" id="fundModalLabel">Loading...</h5>
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
    @if (Auth::user()->role <= 3)
        <script>
            $(document).ready(function() {
                $('#selected_year').on('change', function() {
                    let year = $(this).val();
                    let url = "{{ route('funds') }}" + "?year=" + year;
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
    @endif
@endsection
