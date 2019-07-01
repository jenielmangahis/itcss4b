<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailMessagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_messaging', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->integer('user_id');
            $table->string('recipient');
            $table->string('sender');
            $table->string('subject');
            $table->string('cc');
            $table->string('bcc');
            $table->longText('content');
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
        Schema::dropIfExists('mail_messaging');
    }
}
