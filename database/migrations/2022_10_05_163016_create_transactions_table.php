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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->bigInteger('transcation_id')->unique();
            $table->string('from_or_to_email')->nullable();
            $table->bigInteger('amount');
            $table->json('details')->nullable();
            $table->integer('trans_type')->comment('1=send money,2=cash in,3=cash out,4=add money');
            $table->tinyInteger('status')->comment('1=in,2=out');
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
        Schema::dropIfExists('transactions');
    }
};
