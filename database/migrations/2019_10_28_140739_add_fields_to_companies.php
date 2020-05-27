<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->bigInteger('group_id')->unsigned()->after('website');
            $table->string('created_by')->after('created_at');
            $table->string('updated_by')->after('updated_at');

            $table->foreign('group_id')->references('id')
                ->on('client_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_group_id_foreign');
            $table->dropColumn('group_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
