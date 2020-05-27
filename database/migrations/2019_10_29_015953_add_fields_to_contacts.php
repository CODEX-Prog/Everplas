<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('created_by', 30)->after('created_at');
            $table->string('updated_by', 30)->after('updated_at');
            $table->string('contact_mobile2', 30)->after('contact_mobile');
            $table->string('contact_business_card', 255)->change();
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
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('contact_mobile2');
            $table->dropColumn('contact_business_card');
        });
    }
}
