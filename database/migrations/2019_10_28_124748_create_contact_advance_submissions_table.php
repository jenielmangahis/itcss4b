<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAdvanceSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_advance_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_advance_id')->default(0);
            $table->integer('email_template_id')->default(0);
            $table->longText('recipient');
            $table->string('sender')->nullable();
            $table->string('subject')->nullable();
            $table->longText('content');
            $table->longText('documents');
            $table->string('status',50)->nullable();
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
        Schema::dropIfExists('contact_advance_submissions');
    }
}
