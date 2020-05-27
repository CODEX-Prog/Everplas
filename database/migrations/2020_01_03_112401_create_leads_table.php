<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->string('related');
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('contact_id')->nullable();
            $table->date('date');
            $table->date('till_date');
            $table->string('status');
            $table->bigInteger('employee_id');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('email');
            $table->string('phone');
            $table->float('subtotal');
            $table->float('total_vat');
            $table->float('discount');
            $table->float('total');
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
        Schema::dropIfExists('leads');
    }
}
