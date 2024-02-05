<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entryresults', function (Blueprint $table) {
            $table->unsignedBigInteger('entry_id');
            $table->string('testcode', 255);
            $table->date('sampledate');
            $table->float('result')->nullable();

            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->timestamps();

            // Composite Primary Key
            $table->primary(['entry_id', 'testcode', 'sampledate']);

            // Foreign Key Constraints
            $table->foreign('entry_id')->references('assign_test_id')->on('subassigntest')->onDelete('cascade');
            $table->foreign('testcode')->references('testcode')->on('subassigntest')->onDelete('cascade');

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
        Schema::dropIfExists('entryresults');
    }
}
