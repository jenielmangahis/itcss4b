<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnotherFieldsToContactAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_advances', function (Blueprint $table) {
            $table->integer('sales_user_id')->default(0)->after('lender_id');
            $table->integer('under_writer_user_id')->default(0)->after('sales_user_id');
            $table->integer('closer_user_id')->default(0)->after('under_writer_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_advances', function (Blueprint $table) {
            //
        });
    }
}
