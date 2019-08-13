<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_credit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_id')->default(0);
            $table->string('debit_credit')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_issuer')->nullable();
            $table->string('name_on_card')->nullable();
            $table->string('card_number')->nullable();
            $table->integer('expiration_date_month')->default(0);
            $table->integer('expiration_date_year')->default(0);
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
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
        Schema::dropIfExists('contact_credit_cards');
    }
}
