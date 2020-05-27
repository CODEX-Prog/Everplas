<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultValueOfFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name', 30)->default('aykut can')->change();
            $table->boolean('user_view_permission')->default('1')->change();
            $table->boolean('user_delete_permission')->default('1')->change();
            $table->boolean('user_update_permission')->default('1')->change();
            $table->boolean('user_create_permission')->default('1')->change();
            $table->boolean('crm_view_permission')->default('1')->change();
            $table->boolean('crm_delete_permission')->default('1')->change();
            $table->boolean('crm_update_permission')->default('1')->change();
            $table->boolean('crm_create_permission')->default('1')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('full_name');
            $table->dropColumn('user_view_permission');
            $table->dropColumn('user_delete_permission');
            $table->dropColumn('user_update_permission');
            $table->dropColumn('user_create_permission');
            $table->dropColumn('crm_view_permission');
            $table->dropColumn('crm_delete_permission');
            $table->dropColumn('crm_update_permission');
            $table->dropColumn('crm_create_permission');
        });
    }
}
