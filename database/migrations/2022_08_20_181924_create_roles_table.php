<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        DB::insert('insert into roles (name, description) values (?, ?)', ['Administrator', 'Administrator user in the highest leadership level of the company ']);
        DB::insert('insert into roles (name, description) values (?, ?)', ['Province Representative', 'The Employee at Province level']);
        DB::insert('insert into roles (name, description) values (?, ?)', ['District Representative', 'The Employee at District level']);
        DB::insert('insert into roles (name, description) values (?, ?)', ['Sector Representative', 'The Employee at Sector level']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
