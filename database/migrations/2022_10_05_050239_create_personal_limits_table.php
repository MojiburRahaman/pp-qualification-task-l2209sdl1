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
        Schema::create('personal_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('add_money_limit');
            $table->bigInteger('per_day_money_limit');
            $table->bigInteger('monthly_limit');
            $table->bigInteger('transfer_limit_monthly')->nullable();
            $table->bigInteger('tranfer_monthly_max');
            $table->bigInteger('tranfer_daily_max');
            $table->integer('monthly_cashout_transaction_limit')->nullable();
            $table->bigInteger('per_day_cashout_amount_limit')->nullable();
            $table->bigInteger('per_month_cashout_amount_limit')->nullable();
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
        Schema::dropIfExists('personal_limits');
    }
};
