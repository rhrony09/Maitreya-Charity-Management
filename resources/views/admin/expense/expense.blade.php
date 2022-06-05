@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 text-start">
                            @if ($user->role <= 3)
                                <a href="{{ route('expense.add') }}" class="btn btn-primary btn-sm">Add Expense</a>
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
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center align-middle nowrap" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th width=20%>Details</th>
                                <th>Amount</th>
                                <th>Expense By</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as$expense)
                                <tr>
                                    <td>{{ $loop->remaining + 1 }}</td>
                                    <td>{{ $expense->details }}</td>
                                    <td>{{ moneyFormatBD($expense->amount) }} TK</td>
                                    <td>{{ $expense->member->name ?? 'N/A' }}</td>
                                    <td>{{ $expense->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-edit"></i></a>
                                        <button type="button" data-id="{{ $expense->id }}" class="btn btn-sm btn-danger delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-solid fa-trash"></i></button>
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
                            <h6>Total: <span class="badge bg-danger fs-6">{{ moneyFormatBD($expenses->sum('amount')) }} TK</span></h6>
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
                    let url = "{{ route('expense') }}" + "?filter=" + filter;
                    window.location = url;
                });

                $('.delete').click(function() {
                    let id = $(this).data('id');
                    let url = '{{ route('expense.delete', ':id') }}'
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
