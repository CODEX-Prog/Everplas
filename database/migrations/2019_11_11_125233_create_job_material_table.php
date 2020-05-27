<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->text('description');
            $table->integer('quantity');
            $table->integer('weight');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('job_id')->references('id')
                ->on('job_orders');
            $table->foreign('material_id')->references('id')
                ->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_material');
    }
}
