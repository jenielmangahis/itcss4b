<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvancePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_advance_id')->default(0);
            $table->string('transaction_id',180)->nullable();
            $table->float('amount', 11, 2);
            $table->string('type',15);
            $table->string('payee',180)->nullable();
            $table->integer('payee_id')->default(0);
            $table->mediumText('memo')->nullable();
            $table->string('processed',180)->nullable();
            $table->date('process_date')->nullable();
            $table->date('cleared_date')->nullable();
            $table->string('status',80)->nullable();
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
        Schema::dropIfExists('contact_advance_payments');
    }
}
