<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('purchasing_orders')) {
        Schema::create('purchasing_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject', 255);
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('contact_id')->unsigned()->nullable();
            $table->string('status');
            $table->date('start_date');
            $table->date('due_date');
            $table->integer('amount');
            $table->string('documents', 255);
            $table->bigInteger('employee_id')->unsigned();
            $table->string('importance', 30);
            $table->text('description');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();

            $table->foreign('company_id')->references('id')
                ->on('companies');
            $table->foreign('contact_id')->references('id')
                ->on('contacts');
            $table->foreign('employee_id')->references('id')
                ->on('employees');
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasing_orders');
    }
}
