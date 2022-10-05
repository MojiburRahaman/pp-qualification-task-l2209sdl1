@extends('backend.master')

@section('title',config('app.name') .'- Account')
@section('content')

<!-- Page Heading -->
{{-- <h1 class="h3 mb-2 text-gray-800">Account Type</h1> --}}
<div class="text-right mb-4">
    <a class="btn-sm btn-primary" data-target="#addAccount" data-toggle="modal">
        <i class="fas fa-plus"></i>
        Add</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Account Type</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $account)

                    <tr>
                        <td>{{ $account->name }}</td>
                        <td class="text-center">
                            <a href="" class="ml-2 view" data-id="{{ $account->id }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="" class="ml-2 edit" data-id="{{ $account->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="10">No Data</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Account Type</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('accounttype.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Account Type Name</label>
                                <input id="name" name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="add_money_limit">Add Money Amount Monthly (Max)</label>
                                <input type="number" id="add_money_limit" name="add_money_limit" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="per_day_money_limit">Add Money Amount Per Day (Max)</label>
                                <input type="number" id="per_day_money_limit" name="per_day_money_limit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="monthly_limit">Add Money limit Monthly (Max)</label>
                                <input type="number" id="monthly_limit" name="monthly_limit" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="transfer_limit_monthly">Transfer Limit Monthly (Max)</label>
                                <input type="number" id="transfer_limit_monthly" name="transfer_limit_monthly"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tranfer_monthly_max">Transfer Amount Monthly (Max)</label>
                                <input type="number" id="tranfer_monthly_max" name="tranfer_monthly_max"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tranfer_daily_max">Transfer Amount Daily (Max)</label>
                                <input type="number" id="tranfer_daily_max" name="tranfer_daily_max"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="monthly_cashout_transaction_limit">CashOut Transaction Limit Monthly (Max)</label>
                                <input type="number" id="monthly_cashout_transaction_limit" name="monthly_cashout_transaction_limit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_cashout_amount_per_transaction">Cashout Amount Per Transaction (Min)</label>
                                <input type="number" id="min_cashout_amount_per_transaction" name="min_cashout_amount_per_transaction"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="max_cashout_amount_per_transaction">Cashout Amount Per Transaction (Max)</label>
                                <input type="number" id="max_cashout_amount_per_transaction" name="max_cashout_amount_per_transaction"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="per_day_cashout_amount_limit">Cashout Amount Per Day (Max)</label>
                                <input type="number" id="per_day_cashout_amount_limit" name="per_day_cashout_amount_limit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="per_month_cashout_amount_limit">Cashout Amount Per Month (Max)</label>
                                <input type="number" id="per_month_cashout_amount_limit" name="per_month_cashout_amount_limit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cashout">CashOut Charge (%)</label>
                                <input type="text" id="cashout" name="cashout" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="commision">Commission (%)</label>
                                <input type="text" id="commision" name="commision" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>

@endsection
@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endsection
@section('script_js')
<!-- Page level plugins -->
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script> --}}

<script>
    // $('#modal').modal('toggle');

    @if (session('success'))
        
    Command: toastr["success"]("{{ session('success') }}")
    @endif
    @if (session('warning'))
        
    Command: toastr["success"]("{{ session('warning') }}")
    @endif


$('.edit').click(function(){
    event.preventDefault();
    const id = $(this).attr('data-id');
    $.ajax({
                   type:"get",
                   url: '/admin/accounttype/'+id+'/edit',
                   data: {id:id},
                   success: function(data){
                   $('#modal').html(data.view);
                     $('#modal').modal('toggle');

                   }
               });

})

            $('.view').click(function(){
                event.preventDefault();
                const id = $(this).attr('data-id');
                $.ajax({
                   type:"get",
                   url: '/admin/accounttype/'+id,
                   data: {id:id},
                   success: function(data){
                   $('#modal').html(data.view);
                     $('#modal').modal('toggle');

                   }
               });

})



</script>

@endsection