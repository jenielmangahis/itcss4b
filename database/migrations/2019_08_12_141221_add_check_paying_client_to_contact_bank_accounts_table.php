<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckPayingClientToContactBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_bank_accounts', function (Blueprint $table) {
            $table->tinyInteger('is_check_paying_client')->default(0)->comment('1=yes,0=no');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_bank_accounts', function (Blueprint $table) {
            //
        });
    }
}
