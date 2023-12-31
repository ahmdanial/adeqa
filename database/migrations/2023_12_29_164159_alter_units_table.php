<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop foreign key constraint before dropping the column
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['testcode']);
        });

        // Remove the 'testcode' column
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('testcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // If needed, you can recreate the 'testcode' column and add the foreign key constraint in the down method
        Schema::table('units', function (Blueprint $table) {
            $table->string('testcode', 20)->after('id');
            $table->foreign('testcode')->references('testcode')->on('tests');
        });
    }
}
