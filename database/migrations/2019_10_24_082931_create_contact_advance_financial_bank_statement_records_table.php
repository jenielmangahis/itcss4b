<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvanceFinancialBankStatementRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_financial_bank_statement_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_advance_id')->default(0);
            $table->string('name')->nullable();
            $table->integer('month')->nullable();
            $table->year('year')->nullable();
            $table->float('total_deposits', 11, 2)->nullable();
            $table->float('averate_daily', 11, 2)->nullable();
            $table->float('withdrawal', 11, 2)->nullable();
            $table->float('ending_balance', 11, 2)->nullable();
            $table->integer('deposits')->nullable();
            $table->integer('days_neg')->nullable();
            $table->integer('nsf')->nullable();
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
        Schema::dropIfExists('contact_advance_financial_bank_statement_records');
    }
}
