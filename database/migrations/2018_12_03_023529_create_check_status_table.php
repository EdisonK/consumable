<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $arr = ['通过','拒绝'];
        foreach ($arr as $key => $val){
            \App\Models\CheckStatus::create(['name' => $val]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_status');
    }
}
