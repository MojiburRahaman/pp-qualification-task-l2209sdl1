@extends('backend.master')
@section('title','All Transaction')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Account Type</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Transaction Id</th>
                        <th class="text-center">Amount</th>
                        <th>Email</th>
                        <th class="text-center">Action</th>
                        <th>Method</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Transactions as $Transaction)

                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $Transaction->transcation_id }}</td>
                        <td class="text-center">
                            @if ($Transaction->status == 1)
                            <span class="text-success">{{ $Transaction->amount }}</span>
                            @else
                            <span class="text-danger">{{ $Transaction->amount }}</span>

                            @endif

                        </td>
                        <td>{{ $Transaction->from_or_to_email }}</td>
                        <td class="text-center">

                            @if ($Transaction->status == 1)
                            <a class="btn btn-outline-success">In</a>

                            @else
                            <a class="btn btn-outline-danger">Out</a>
                            @endif
                        </td>
                        <td>
                            @if ($Transaction->trans_type == 1)
                            Send Money
                            @elseif($Transaction->trans_type == 2)
                            Cash In
                            @elseif($Transaction->trans_type == 3)
                            Cash Out
                            @elseif($Transaction->trans_type == 4)
                            Add Money
                            @endif
                        </td>
                        <td>
                            {{ $Transaction->created_at->diffForhumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="10">No Transaction</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/autofill/2.4.0/css/autoFill.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/searchbuilder/1.3.4/css/searchBuilder.dataTables.min.css" rel="stylesheet">

@endsection
@section('script_js')
<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.4.0/js/dataTables.autoFill.min.js"></script>
<script src="https://cdn.datatables.net/searchbuilder/1.3.4/js/dataTables.searchBuilder.min.js"></script>
<script type="text/javascript" src="dataTables.scrollingPagination.js"></script>
{{-- <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}

<script>
    $(document).ready(function () {
    $('#dataTable').DataTable({
        
        buttons: [
        'copy', 'excel', 'pdf'
    ]
    });
});
</script>
@endsection