<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('产品或者试剂的名称');
            $table->string('chinese_name')->comment('中文别名')->nullable();
            $table->string('english_name')->comment('英文别名')->nullable();
            $table->string('cas')->comment('cas号')->nullable();
            $table->string('molecular_formula')->comment('分子式')->nullable();
            $table->integer('brand_id')->comment('品牌id')->nullable();
            $table->float('price')->comment('单价')->nullable();
            $table->string('unit')->comment('单位')->nullable();
            $table->string('model_type')->comment('型号规格')->nullable();
            $table->integer('category_id')->comment('该产品所属的种类的id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
