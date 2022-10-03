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
            <p>Transfer Monthly Max amount: {{ $account->tranfer_monthly_max }}</p>
            <p>Transfer Daily Max amount: {{ $account->tranfer_daily_max }}</p>
            @isset($account->cashout )
            <p>Cashout: {{ $account->cashout }} %</p>
            @endisset
            @isset($account->commision )

            <p>Comission: {{ $account->commision }} %</p>
            @endisset
        </div>
    </div>
</div>