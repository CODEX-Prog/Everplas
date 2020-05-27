<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('asset_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('description', 255);
            $table->bigInteger('mainten_employee_id')->unsigned();
            $table->bigInteger('super_employee_id')->unsigned();
            $table->bigInteger('review_employee_id')->unsigned();
            $table->date('review_date');
            $table->date('close_date');
            $table->text('reports');
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
            $table->timestamps();

            $table->foreign('asset_id')->references('id')
                ->on('assets');
            $table->foreign('company_id')->references('id')
                ->on('companies');
            $table->foreign('mainten_employee_id')->references('id')
                ->on('employees');
            $table->foreign('super_employee_id')->references('id')
                ->on('employees');
            $table->foreign('review_employee_id')->references('id')
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
        Schema::dropIfExists('maintenances');
    }
}
