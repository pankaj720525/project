<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();
            $table->bigInteger('subscription_id')->nullable()->index();
            $table->string('transaction_id', 250)->nullable();
            $table->string('profile_id', 250)->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('receipt')->nullable();
            $table->tinyInteger('is_cancel')->default(0)->index();
            $table->tinyInteger('is_payment_received')->default(0)->index()->comment('0-pending,1-received,2-not receive');
            $table->dateTime('profile_start_date')->nullable();
            $table->tinyInteger('is_renew')->default(0)->index();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_sync')->default(0)->index();
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
        Schema::dropIfExists('subscribe_users');
    }
}
