<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('profile')->nullable();
            $table->rememberToken();
            $table->dateTime('reset_token')->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->index('status');
            $table->tinyInteger('is_verified')->default(0)->index('is_verified')->comment('0 = pending,1 = verified');
            $table->string('access_token')->nullable();
            $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('users');
    }
}
