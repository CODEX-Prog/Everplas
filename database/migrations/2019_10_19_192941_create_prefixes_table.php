<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefixes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice', 30);
            $table->string('quotation', 30);
            $table->string('estimation', 30);
            $table->string('po', 30);
            $table->string('joborder', 30);
            $table->string('receipt', 30);
            $table->string('credit_note', 30);
            $table->string('receiving', 30);
            $table->string('employee', 30);
            $table->string('accenting', 30);
            $table->string('bank', 30);
            $table->string('transaction', 30);
            $table->string('purchase', 30);
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
        Schema::dropIfExists('prefixes');
    }
}
