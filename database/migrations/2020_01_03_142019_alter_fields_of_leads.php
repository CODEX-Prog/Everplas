<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldsOfLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable()->change();
            $table->bigInteger('contact_id')->unsigned()->nullable()->change();
            $table->bigInteger('employee_id')->unsigned()->nullable()->change();
            $table->string('created_by');
            $table->string('updated_by');

            $table->foreign('company_id')->references('id')
                ->on('companies');
            $table->foreign('contact_id')->references('id')
                ->on('contacts');
            $table->foreign('employee_id')->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');

            $table->dropForeign('company_id');
            $table->dropForeign('contact_id');
            $table->dropForeign('employee_id');
        });
    }
}
