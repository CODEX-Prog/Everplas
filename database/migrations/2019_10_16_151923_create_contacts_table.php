<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('contact_name', 30);
            $table->char('contact_email', 30);
            $table->char('contact_telephone', 30);
            $table->char('contact_mobile', 30)->nullable(true);
            $table->char('contact_job', 30);
            $table->char('contact_country', 30);
            $table->char('contact_business_card');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
