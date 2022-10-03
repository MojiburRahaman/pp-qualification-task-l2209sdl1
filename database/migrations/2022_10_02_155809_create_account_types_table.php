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
            $table->bigInteger('tranfer_monthly_max');
            $table->bigInteger('tranfer_daily_max');
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
