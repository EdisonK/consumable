<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('产品的id');
            $table->integer('total_count')->comment('我的私人仓库剩余多少数量');
            $table->string('location')->comment('这个药品放在什么地方')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('private_inventories');
    }
}
