<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_id')->default(0);
            $table->integer('company_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('source_id')->default(0);
            $table->integer('media_type_id')->default(0);
            $table->string('title');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('priority')->default(0);
            $table->float('campaign_cost', 11, 2)->default(0);
            $table->float('purchase_amount', 11, 2)->default(0);
            $table->tinyInteger('status')->default(1)->comment('1=active,2=inactive');
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
        Schema::dropIfExists('contact_campaigns');
    }
}
