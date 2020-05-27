<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsIntoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
            $table->char('full_name', 30);
            $table->boolean('user_view_permission');
            $table->boolean('user_delete_permission');
            $table->boolean('user_update_permission');
            $table->boolean('user_create_permission');
            $table->boolean('crm_view_permission');
            $table->boolean('crm_delete_permission');
            $table->boolean('crm_update_permission');
            $table->boolean('crm_create_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function($table) {
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
