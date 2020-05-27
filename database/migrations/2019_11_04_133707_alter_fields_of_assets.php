<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldsOfAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('prefix', 255)->change();
            $table->string('name', 255)->change();
            $table->string('manufacturer', 255)->change();
            $table->string('classification', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('prefix');
            $table->dropColumn('name');
            $table->dropColumn('manufacturer');
            $table->dropColumn('classification');
        });
    }
}
