<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('street');
            $table->string('suburb')->nullable();
            $table->string('city',90)->nullable();
            $table->string('state',90)->nullable();
            $table->string('zip_code',35)->nullable();
            $table->string('country',90)->nullable();
            $table->string('phone',90)->nullable();
            $table->string('email',150)->nullable();
            $table->string('url_site',190)->nullable();
            $table->longText('notes',90)->nullable();
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
        Schema::dropIfExists('lenders');
    }
}
