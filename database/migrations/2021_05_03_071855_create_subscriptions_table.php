<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_name');
            $table->text('description')->nullable();
            $table->enum('billing_period', ['day', 'month', 'year','lifetime'])->default('month')->index();
            $table->integer('billing_frequency')->default(1);
            $table->double('price', 10, 2)->default(0.00);
            $table->tinyInteger('status')->default(1)->index();
            $table->tinyInteger('is_delete')->default(0);
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
        Schema::dropIfExists('subscriptions');
    }
}
