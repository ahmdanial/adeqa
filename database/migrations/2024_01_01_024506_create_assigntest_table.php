<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAssigntestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_test', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('lab_id')->unique();
            $table->unsignedBigInteger('prog_id');
            $table->unsignedBigInteger('instrument_id');
            $table->unsignedBigInteger('reagent_id');
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('prog_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('instrument_id')->references('id')->on('instruments')->onDelete('cascade');
            $table->foreign('reagent_id')->references('id')->on('reagents')->onDelete('cascade');
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('update_by')->references('id')->on('users')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_test');
    }
}
