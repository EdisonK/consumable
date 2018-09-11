<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('losses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('产品的id');
            $table->integer('loss_count')->comment('损耗的数量');
            $table->string('note')->comment('损耗的原因')->nullable();
            $table->integer('creator_id')->comment('创建人的id');
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
        Schema::dropIfExists('losses');
    }
}
