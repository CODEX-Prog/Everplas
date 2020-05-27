<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prefix_id', 255);
            $table->string('name', 100);
            $table->string('code', 100);
            $table->string('weight', 30);
            $table->string('color', 30);
            $table->string('thickness', 30);
            $table->string('length', '30');
            $table->string('wt_size', 30);
            $table->string('ending', 30);
            $table->string('price', 30);
            $table->text('photos');
            $table->string('quantity', 30);
            $table->string('issue', 100);
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
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
        Schema::dropIfExists('products');
    }
}
