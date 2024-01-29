<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubassigntestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subassigntest', function (Blueprint $table) {
            $table->unsignedBigInteger('assign_test_id');
            $table->string('testcode', 255);
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('unit_id');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('assign_test_id')->references('id')->on('assign_test')->onDelete('cascade');
            $table->foreign('testcode')->references('testcode')->on('tests')->onDelete('cascade');
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subassigntest');
    }
}
