<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('contact_id')->unsigned()->nullable();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);

            $table->foreign('company_id')->references('id')
                ->on('companies');
            $table->foreign('contact_id')->references('id')
                ->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign('materials_company_id');
            $table->dropForeign('materials_contact_id');

            $table->dropColumn('company_id');
            $table->dropColumn('contact_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
