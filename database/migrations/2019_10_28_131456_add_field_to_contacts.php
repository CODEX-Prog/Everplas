<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->after('contact_job');
            $table->bigInteger('group_id')->unsigned()->after('contact_country');

            $table->foreign('company_id')->references('id')
                ->on('companies');
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('group_id');
            $table->dropForeign('contacts_company_id_foreign');
            $table->dropForeign('contacts_group_id_foreign');
        });
    }
}
