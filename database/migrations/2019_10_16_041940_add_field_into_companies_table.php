<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldIntoCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('companies', function($table) {
            $table->char('vat_number', 20);
            $table->char('fax', 20);
            $table->char('website', 50);
            $table->char('address', 50);
            $table->char('city', 50);
            $table->char('country', 30);
            $table->char('company_card', 30);
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
        Schema::table('companies', function($table) {
            $table->dropColumn('vat_number');
            $table->dropColumn('fax');
            $table->dropColumn('website');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('company_card');
        });
    }
}
