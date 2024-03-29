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
            $table->timestamps();

            $table->primary(['assign_test_id', 'testcode']);

            // Foreign Key Constraints
            $table->foreign('assign_test_id')->references('id')->on('assign_test')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('testcode')->references('testcode')->on('tests')->onDelete('restrict')->onUpdate('cascade');
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
