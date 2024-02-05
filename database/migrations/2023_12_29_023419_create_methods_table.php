<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('methods', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('reagent_id');
            $table->string('testcode', 255);
            $table->string('methodname')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->timestamps();

             $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

             // Foreign key relationship with the 'reagents' table
             $table->foreign('reagent_id')->references('id')->on('reagents');

             // Foreign key relationship with the 'tests' table
             $table->foreign('testcode')->references('testcode')->on('tests');

             // Foreign key relationship with the 'users' table for added_by
             $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');;

             // Foreign key relationship with the 'users' table for update_by
             $table->foreign('update_by')->references('id')->on('users')->onDelete('set null');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('methods');
    }
}
