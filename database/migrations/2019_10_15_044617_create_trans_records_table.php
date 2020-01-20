<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payed_by');
            $table->integer('amt_payed');
            $table->integer('balance');            
            $table->integer('house_id');
            $table->string('date_payed');
            $table->string('payment_mode');
            $table->string('payment_mode_value');
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
        Schema::dropIfExists('trans_records');
    }
}
