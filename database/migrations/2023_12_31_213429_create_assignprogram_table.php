<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignprogramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id');
            $table->unsignedBigInteger('prog_id');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->timestamps();

            // Foreign Key (assuming 'programs' is the related table)
            $table->foreign('prog_id')->references('id')->on('programs')->onDelete('cascade');

            // Foreign Key (assuming 'labs' is the related table)
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');

            // Foreign key relationship with the 'users' table for added_by
            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');

            // Foreign key relationship with the 'users' table for update_by
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
        Schema::dropIfExists('assignprogram');
    }
}
