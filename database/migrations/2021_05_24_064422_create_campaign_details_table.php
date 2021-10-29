<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id')->index();
            $table->string('name')->nullable();
            $table->string('keywords')->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->text('city');
            $table->bigInteger('search_type_id')->index();
            $table->string('website')->nullable();
            $table->text('response')->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->index('status');
            $table->tinyInteger('is_delete')->nullable()->default(0)->index('is_delete');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_details');
    }
}
