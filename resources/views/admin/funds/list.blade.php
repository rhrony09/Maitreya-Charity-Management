@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 text-start">
                            @if ($user->role <= 3)
                                <a href="{{ route('funds.add') }}" class="btn btn-primary btn-sm">Add Fund</a>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <h3 class="text-center">{{ $page_title }}</h3>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <span class="me-2">Filter:</span>
                            <select class="form-select" id="filter">
                                <option value="7days" @if ($filter == '7days') selected @endif>Last 7 Days</option>
                                <option value="30days" @if ($filter == '30days') selected @endif>Last 30 Days</option>
                                <option value="thismonth" @if ($filter == 'thismonth') selected @endif>This Month</option>
                                <option value="lastmonth" @if ($filter == 'lastmonth') selected @endif>Last Month</option>
                                <option value="thisyear" @if ($filter == 'thisyear') selected @endif>This Year</option>
                                <option value="lastyear" @if ($filter == 'lastyear') selected @endif>Last Year</option>
                                <option value="all" @if ($filter == 'all' || $filter == '') selected @endif>All</option>
                            </select>
                            <a href="{{ route('funds') }}" class="btn ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Year View"><i class="bi bi-grid-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center align-middle nowrap" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th width=20%>Member</th>
                                <th>Amount</th>
                                <th>Month</th>
                                <th>Payment Method</th>
                                <th>Type</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($funds as$fund)
                                <tr>
                                    <td>{{ $loop->remaining + 1 }}</td>
                                    <td>{{ is_numeric($fund->user_id) ? $fund->member->name : $fund->user_id }}</td>
                                    <td>{{ $fund->amount }} TK</td>
                                    <td>{{ $fund->months->name }}, {{ $fund->year }}</td>
                                    <td>{{ $fund->payment_methods->name ?? '-' }}</td>
                                    <td>{{ $fund->type == 1 ? 'Recurring' : 'One Time' }}</td>
                                    <td>{{ $fund->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ route('funds.edit', $fund->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-edit"></i></a>
                                        <button type="button" data-id="{{ $fund->id }}" class="btn btn-sm btn-danger delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <h6>Total: <span class="badge bg-info fs-6">{{ moneyFormatBD($funds->sum('amount')) }} TK</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if ($user->role <= 3)
        <script>
            $(document).ready(function() {
                $('#filter').on('change', function() {
                    let filter = $(this).val();
                    let url = "{{ route('funds.list') }}" + "?filter=" + filter;
                    window.location = url;
                });

                $('.delete').click(function() {
                    let id = $(this).data('id');
                    let url = '{{ route('funds.delete', ':id') }}'
                    url = url.replace(':id', id);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This fund will be deleted permanently!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = url;
                        }
                    })
                });
            });
        </script>
    @endif
@endsection
