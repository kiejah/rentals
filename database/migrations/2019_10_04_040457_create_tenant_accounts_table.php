<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('monthly_rent');
            $table->integer('balance_bf');
            $table->integer('amt_payable');
            $table->integer('amt_payed');
            $table->integer('balance_cf');
            $table->string('receipt_no');
            $table->string('cheque_no');
            $table->string('mpesa_tid'); 
            $table->string('date_payed');           
            $table->string('for_house_no');
            $table->string('current_tenant');
            $table->string('contact_tel');
            $table->integer('payment_mode');
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
        Schema::dropIfExists('tenant_accounts');
    }
}
