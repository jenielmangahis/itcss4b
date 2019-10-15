<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvanceUnderwriterNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_underwriter_notes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->mediumText('under_writer_opinion')->nullable();
            $table->mediumText('tax_liens_judgements')->nullable();
            $table->mediumText('ucc_position')->nullable();
            $table->mediumText('advance_history_comments')->nullable();
            $table->mediumText('major_issues')->nullable();
            $table->mediumText('required_paperworks_information')->nullable();

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
        Schema::dropIfExists('contact_advance_underwriter_notes');
    }
}
