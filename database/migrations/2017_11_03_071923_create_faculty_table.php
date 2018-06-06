<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Dname");
        });

        DB::table('departments')->insert([
            ['Dname' => 'School of Computing'],
            ['Dname' => 'School of Business'],
            ['Dname' => 'School of Engineering'],
            ['Dname' => 'Administration'],
            ['Dname' => 'Maintainance'],
            ['Dname' => 'Marketing']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty');
    }
}
