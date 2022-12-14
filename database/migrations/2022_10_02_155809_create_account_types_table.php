<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('add_money_limit');
            $table->bigInteger('per_day_money_limit');
            $table->bigInteger('monthly_limit');
            $table->bigInteger('tranfer_monthly_max')->nullable();
            $table->integer('transfer_limit_monthly')->nullable();
            $table->bigInteger('tranfer_daily_max')->nullable();
            $table->integer('monthly_cashout_transaction_limit')->nullable();
            $table->integer('min_cashout_amount_per_transaction')->nullable();
            $table->integer('max_cashout_amount_per_transaction')->nullable();
            $table->bigInteger('per_day_cashout_amount_limit')->nullable();
            $table->bigInteger('per_month_cashout_amount_limit')->nullable();
            $table->float('commision')->nullable();
            $table->float('cashout')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_types');
    }
};
