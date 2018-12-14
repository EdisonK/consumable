<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColToLossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('losses', function (Blueprint $table) {
            $table->integer('inventory_id')->commet('公用库存的id')->nullable()->after('id');
            $table->integer('private_inventory_id')->commet('私用库存的id')->nullable()->after('inventory_id');
            $table->integer('checker_id')->commet('审核人的id')->nullable();
            $table->timestamp('checked_at')->commet('审核时间')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('losses', function (Blueprint $table) {
            $table->dropColumn(['inventory_id','private_inventory_id','checker_id','checked_at']);
        });
    }
}
