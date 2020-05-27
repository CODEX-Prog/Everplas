<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prefix', 30);
            $table->string('name', 30);
            $table->text('description');
            $table->string('manufacturer', 30)->nullable();
            $table->date('delivery_date')->nullable();
            $table->integer('cost')->nullable();
            $table->string('classification', 30);
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('contact_id')->unsigned()->nullable();
            $table->string('location', 30);
            $table->string('type', 30);
            $table->bigInteger('employee_id')->unsigned();
            $table->string('serial', 30);
            $table->date('warranty_date')->nullable();
            $table->text('attachments')->nullable();
            $table->string('created_by', 30);
            $table->string('updated_by', 30);
            $table->timestamps();

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
        Schema::dropIfExists('assets');
    }
}
