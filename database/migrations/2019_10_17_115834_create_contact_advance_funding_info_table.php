<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvanceFundingInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_funding_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_advance_id')->default(0);
            //Funding Details
            $table->date('contract_date')->nullable();
            $table->string('contract_number',100)->nullable();
            $table->date('funding_date')->nullable();
            $table->string('wire_conf_number',100)->nullable();
            //Merchant Bank Account
            $table->string('routing_number',150)->nullable();
            $table->string('account_number',150)->nullable();
            $table->string('account_type',100)->nullable();
            $table->string('name_of_account',150)->nullable();
            $table->string('ach_gateway',150)->nullable();

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
        Schema::dropIfExists('contact_advance_funding_info');
    }
}
