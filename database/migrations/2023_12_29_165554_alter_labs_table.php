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
            $table->dropForeign(['institution_id']);
        });

        // Add the new foreign key constraint with cascade option
        Schema::table('labs', function (Blueprint $table) {
            $table->foreign('institution_id')
                  ->references('id')->on('institutions')
                  ->onDelete('cascade');
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
            $table->dropForeign(['institution_id']);
        });

        // Recreate the foreign key constraint without cascade option
        Schema::table('labs', function (Blueprint $table) {
            $table->foreign('institution_id')->references('id')->on('institutions');
        });
    }
}
