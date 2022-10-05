<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4>
                Name : {{ $account->name }}
            </h4>
            <p>Add Money Limit : {{ $account->add_money_limit }}</p>
            <p>Per Day Money Limit : {{ $account->per_day_money_limit }}</p>
            <p>Monthly Add Limit : {{ $account->monthly_limit }}</p>
            <p>Transfer Monthly Max Limit: {{ $account->transfer_limit_monthly }}</p>
            <p>Transfer Monthly Max amount: {{ $account->tranfer_monthly_max }}</p>
            <p>Transfer Daily Max amount: {{ $account->tranfer_daily_max }}</p>
            @isset($account->monthly_cashout_transaction_limit )
            <p>Monthly Cashout Transaction Limit: {{ $account->monthly_cashout_transaction_limit }} </p>
            @endisset
            @isset($account->min_cashout_amount_per_transaction )
            <p>Per Transaction Cashout Amount (Min): {{ $account->min_cashout_amount_per_transaction }} </p>
            @endisset
            @isset($account->max_cashout_amount_per_transaction )
            <p>Per Transaction Cashout Amount (Max): {{ $account->max_cashout_amount_per_transaction }} </p>
            @endisset
            @isset($account->per_day_cashout_amount_limit )
            <p>Per Day Cashout Amount (Max): {{ $account->per_day_cashout_amount_limit }} </p>
            @endisset
            @isset($account->per_month_cashout_amount_limit )
            <p>Per Month Cashout Amount (Max): {{ $account->per_month_cashout_amount_limit }} </p>
            @endisset
            @isset($account->cashout )
            <p>Cashout: {{ $account->cashout }} %</p>
            @endisset
            @isset($account->commision )
            <p>Comission: {{ $account->commision }} %</p>
            @endisset
        </div>
    </div>
</div>