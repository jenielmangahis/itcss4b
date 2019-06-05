<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactBusinessInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_business_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_id')->default(0);
            $table->integer('company_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('business_name')->nullable();
            $table->decimal('years_in_business', 8, 2);
            $table->string('legal_entity_of_business')->nullable();
            $table->string('accept_credit_card_from_customer',50);
            $table->float('gross_monthly_credit_card_sales', 11, 2);
            $table->float('gross_yearly_sales', 11, 2);
            $table->string('filed_bankruptcy',20); // Yes or No
            $table->date('bankruptcy_filed');
            $table->string('credit_score',100);
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
        Schema::dropIfExists('contact_business_informations');
    }
}
