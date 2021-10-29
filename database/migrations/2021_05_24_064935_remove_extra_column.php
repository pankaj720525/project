<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveExtraColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns_masters', function (Blueprint $table) {
            $table->tinyInteger('user_id')->index()->after('id');
            $table->tinyInteger('is_mail_result')->default(0)->index()->after('search_type_id');
            $table->dropColumn('response');
            $table->dropColumn('username');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns_masters', function (Blueprint $table) {
            //
        });
    }
}
