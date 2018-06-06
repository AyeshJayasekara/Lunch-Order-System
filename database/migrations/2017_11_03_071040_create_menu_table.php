<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->timestamps();
        });

        DB::table('menu')->insert([
            ['type' => 'Chicken with Red Rice'],
            ['type' => 'Chicken with White Rice'],
            ['type' => 'Fish with Red Rice'],
            ['type' => 'Fish with White Rice'],
            ['type' => 'Egg with Red Rice'],
            ['type' => 'Egg with White Rice'],
            ['type' => 'Vegi with Red Rice'],
            ['type' => 'Vegi with White Rice'],
            ['type' => 'Fried Rice']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
