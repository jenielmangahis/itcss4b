<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',250);
            $table->date('event_date');
            $table->time('event_time');
            $table->integer('event_type_id');
            $table->integer('user_id')->comment('assigned this event to particular user'); //assigned_to
            $table->mediumText('location')->nullable();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('contact_events');
    }
}
