<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('full_name', 30);
            $table->char('email', 30);
            $table->date('birthday');
            $table->boolean('marital');
            $table->char('phone', 20);
            $table->boolean('gender');
            $table->char('nationality', 20);
            $table->char('address', 50);
            $table->integer('crp_number');
            $table->date('crp_exp');
            $table->integer('passport_number');
            $table->date('passport_exp');
            $table->integer('working_as');
            $table->integer('department_id');
            $table->char('destination', 50);
            $table->date('join_date');
            $table->date('end_date');
            $table->integer('leaves_day');
            $table->integer('salary_transfer_type');
            $table->integer('basic_salary');
            $table->integer('employee_cosi');
            $table->integer('company_cosi');
            $table->integer('lmra_monthly_fee');
            $table->integer('lmra_visa_fee');
            $table->date('visa_exp_date');
            $table->integer('bank_id');
            $table->char('iban', 50);
            $table->char('short_name', 30);
            $table->boolean('driving_license');
            $table->char('blood_type');
            $table->char('emerg_contact_name');
            $table->integer('emerg_contact_number');
            $table->char('emerg_contact_relation');
            $table->integer('commotion_type');
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
        Schema::dropIfExists('employees');
    }
}
