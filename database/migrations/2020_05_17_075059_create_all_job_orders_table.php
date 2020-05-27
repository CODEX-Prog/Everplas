<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_job_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('P_id')->unsigned()->nullable();
            $table->bigInteger('R_id')->unsigned()->nullable();
            $table->bigInteger('L_id')->unsigned()->nullable();
            $table->string('requested_by');
            $table->string('from');
            $table->text('description');
            $table->date('date');
            $table->bigInteger('day_ago');
            $table->string('related');
            $table->string('status');
            $table->string('Job_id')->unique();
            $table->timestamps();

            $table->foreign('P_id')->references('id')
            ->on('purchasing_orders');
            $table->foreign('R_id')->references('id')
            ->on('job_orders');
            $table->foreign('L_id')->references('id')
            ->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_job_orders');
    }
}
