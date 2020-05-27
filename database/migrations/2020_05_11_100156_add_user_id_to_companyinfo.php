<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToCompanyinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_information', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_information', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
