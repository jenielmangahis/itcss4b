<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactBrokerInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_broker_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_id')->default(0);
            $table->integer('company_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->float('brokerage_fee', 11, 2);
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
        Schema::dropIfExists('contact_broker_informations');
    }
}
