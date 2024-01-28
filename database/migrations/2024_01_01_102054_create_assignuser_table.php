<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_users', function (Blueprint $table) {
            $table -> string('user_code', 20) -> primary();
            $table -> unsignedBigInteger('user_id');
            $table -> unsignedBigInteger('lab_id');
            $table -> unsignedBigInteger('added_by') -> nullable();
            $table -> unsignedBigInteger('update_by') -> nullable();
            $table -> timestamps();

            // Foreign Key (assuming 'users' is the related table)
            $table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');

            // Foreign Key (assuming 'labs' is the related table)
            $table -> foreign('lab_id') -> references('id') -> on('labs') -> onDelete('cascade');

            // Foreign key relationship with the 'users' table for added_by
            $table -> foreign('added_by') -> references('id') -> on('users') -> onDelete('set null');

            // Foreign key relationship with the 'users' table for update_by
            $table -> foreign('update_by') -> references('id') -> on('users') -> onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignuser');
    }
}
