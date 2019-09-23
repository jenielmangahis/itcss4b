<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_id',90);
            $table->date('contract_date')->nullable();
            $table->string('contract_number',100);
            $table->date('advance_date')->nullable();
            $table->float('amount', 11, 2);
            $table->float('payback', 11, 2);
            $table->float('balance', 11, 2);
            $table->float('factor_rate', 11, 2);
            $table->float('remit', 11, 2);
            $table->string('period',35)->nullable();
            $table->float('payment', 11, 2);
            $table->string('advance_type',35)->nullable();
            $table->string('payment_method',35)->nullable();
            $table->string('status',35)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_advances');
    }
}
