<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaymentsHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->dateTime('start_date')->nullable()->after('amount');
            $table->dateTime('end_date')->nullable()->after('start_date');
            $table->double('search_limit')->default(0)->after('end_date');
            $table->tinyInteger('is_unlimited')->default(0)->index()->after('search_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            //
        });
    }
}
