<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing foreign key constraint
        Schema::table('labs', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });

        // Add the new foreign key constraint with cascade option
        Schema::table('labs', function (Blueprint $table) {
            $table->foreign('department_id')
                  ->references('id')->on('departments')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the foreign key constraint added in the 'up' method
        Schema::table('labs', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });

        // Recreate the foreign key constraint without cascade option
        Schema::table('labs', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }
}
