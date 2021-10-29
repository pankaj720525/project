<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns_masters', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('keywords')->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->text('city');
            $table->bigInteger('search_type_id')->index();
            $table->string('website')->nullable();
            $table->text('response')->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->index('status');
            $table->tinyInteger('is_delete')->nullable()->default(0)->index('is_delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns_masters');
    }
}
