<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        \App\Models\Role::create([
            'name' => '管理员',
        ]);
        \App\Models\Role::create([
            'name' => '老师',
        ]);
        \App\Models\Role::create([
            'name' => '组长',
        ]);
        \App\Models\Role::create([
            'name' => '学生',
        ]);
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
}
