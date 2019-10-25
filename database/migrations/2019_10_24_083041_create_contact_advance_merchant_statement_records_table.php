<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvanceMerchantStatementRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_merchant_statement_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_advance_id')->default(0);
            $table->string('name')->nullable();
            $table->integer('month')->nullable();
            $table->year('year')->nullable();
            $table->float('total_volume', 11, 2)->nullable();
            $table->float('visa_ms_disc', 11, 2)->nullable();
            $table->float('amex', 11, 2)->nullable();
            $table->float('charge_back_volume', 11, 2)->nullable();
            $table->integer('transaction')->nullable();
            $table->integer('batches')->nullable();
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
        Schema::dropIfExists('contact_advance_merchant_statement_records');
    }
}
