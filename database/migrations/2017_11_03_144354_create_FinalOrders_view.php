<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalOrdersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW Final_Orders AS SELECT  distinct users.name, departments.Dname , menu.type  from users , menu , departments , orders , employees WHERE orders.email=users.email and orders.prefer=menu.id and employees.email=orders.email and employees.faculty=departments.id GROUP BY departments.Dname, menu.type, users.name');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW Final_Orders');
    }
}
