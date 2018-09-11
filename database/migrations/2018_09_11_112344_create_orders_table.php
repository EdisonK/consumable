<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('产品的id');
            $table->integer('count')->comment('需要订购的数量');
            $table->string('note')->comment('备注，订购中可能需要填写的')->nullable();
            $table->integer('creator_id')->comment('创建人的id');
            $table->integer('checker_id')->comment('审核人的id')->nullable();
            $table->timestamp('checked_at')->comment('审核时间')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
