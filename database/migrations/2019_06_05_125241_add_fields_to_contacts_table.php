<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('full_name',120)->after('user_id')->nullable();
            $table->mediumText('address1')->after('home_number')->nullable();
            $table->mediumText('address2')->after('address1')->nullable();
            $table->string('city',120)->after('address2')->nullable();
            $table->string('state',120)->after('city')->nullable();
            $table->string('zip_code',120)->after('state')->nullable();
            $table->integer('stage_id')->default(0)->after('user_id');
            $table->string('status',50)->after('stage_id')->nullable();
            $table->string('data_source',50)->after('home_number')->nullable();
            $table->dateTime('last_call_activity')->after('data_source')->nullable();
            $table->string('time_in_status',50)->after('last_call_activity')->nullable();
        });
    }  

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
}
