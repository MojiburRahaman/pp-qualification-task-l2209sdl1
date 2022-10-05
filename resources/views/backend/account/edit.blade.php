
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Account Type</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('accounttype.update',$account->id) }}" method="POST">
            @method('PUT')
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Account Type Name</label>
                            <input value="{{ $account->name }}" id="name" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="add_money_limit">Add Money Amount Monthly (Max)</label>
                            <input value="{{ $account->add_money_limit }}" type="number" id="add_money_limit"
                                name="add_money_limit" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="per_day_money_limit">Add Money Amount Per Day (Max)</label>
                            <input type="number" id="per_day_money_limit" name="per_day_money_limit"
                                value="{{ $account->per_day_money_limit }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="monthly_limit">Add Money limit Monthly (Max)</label>
                            <input type="number" id="monthly_limit" name="monthly_limit" class="form-control"
                                value="{{ $account->monthly_limit }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="transfer_limit_monthly">Transfer Limit Monthly (Max)</label>
                            <input type="number" id="transfer_limit_monthly" name="transfer_limit_monthly"
                                value="{{ $account->transfer_limit_monthly }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tranfer_monthly_max">Transfer Amount Monthly (Max)</label>
                            <input type="number" id="tranfer_monthly_max" name="tranfer_monthly_max"
                                value="{{ $account->tranfer_monthly_max }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tranfer_daily_max">Transfer Amount Daily (Max)</label>
                            <input type="number" id="tranfer_daily_max" name="tranfer_daily_max"
                                value="{{ $account->tranfer_daily_max }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="monthly_cashout_transaction_limit">CashOut Transaction Limit Monthly (Max)</label>
                            <input value="{{ $account->monthly_cashout_transaction_limit }}" type="number" id="monthly_cashout_transaction_limit" name="monthly_cashout_transaction_limit"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="min_cashout_amount_per_transaction">Cashout Amount Per Transaction (Min)</label>
                            <input value="{{ $account->min_cashout_amount_per_transaction }}" type="number" id="min_cashout_amount_per_transaction" name="min_cashout_amount_per_transaction"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="max_cashout_amount_per_transaction">Cashout Amount Per Transaction (Max)</label>
                            <input value="{{ $account->max_cashout_amount_per_transaction }}" type="number" id="max_cashout_amount_per_transaction" name="max_cashout_amount_per_transaction"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="per_day_cashout_amount_limit">Cashout Amount Per Day (Max)</label>
                            <input value="{{ $account->per_day_cashout_amount_limit }}" type="number" id="per_day_cashout_amount_limit" name="per_day_cashout_amount_limit"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="per_month_cashout_amount_limit">Cashout Amount Per Month (Max)</label>
                            <input value="{{ $account->per_month_cashout_amount_limit }}" type="number" id="per_month_cashout_amount_limit" name="per_month_cashout_amount_limit"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cashout">CashOut Charge (%)</label>
                            <input type="text" id="cashout" name="cashout" class="form-control"
                                value="{{ $account->cashout }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="commision">Commission (%)</label>
                            <input type="text" id="commision" name="commision" class="form-control"
                                value="{{ $account->commision }}">
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