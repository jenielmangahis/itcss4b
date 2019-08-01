<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactCallTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_call_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('contact_id');
            $table->string('call_type',90)->nullable();
            $table->string('call_result',90)->nullable();
            $table->string('call_minutes',20)->nullable();
            $table->string('call_seconds',20)->nullable();
            $table->mediumText('notes')->nullable();
            $table->integer('event_type_id');
            $table->string('call_update_status',30)->nullable();
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
        Schema::dropIfExists('contact_call_trackers');
    }
}
