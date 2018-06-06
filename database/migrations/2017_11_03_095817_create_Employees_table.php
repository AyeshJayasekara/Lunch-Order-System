<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->integer('Faculty');
            $table->timestamps();
        });

        DB::unprepared('
        CREATE TRIGGER tr_User AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO Employees (`email`, `faculty` ) 
                VALUES (NEW.email, 1);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Employees');
    }
}
