<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvanceParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_participation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_advance_id')->default(0);
            $table->integer('lender_id')->default(0);
            $table->float('loan_amount', 11, 2)->nullable();
            $table->float('loan_amount_percent', 11, 2)->nullable();
            $table->float('fee_amount', 11, 2)->nullable();
            $table->float('fee_percent', 11, 2)->nullable();
            $table->string('type',50)->nullable();     
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
        Schema::dropIfExists('contact_advance_participation');
    }
}
