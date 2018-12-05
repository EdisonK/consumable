<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('check_status_id')->comment('客户审核状态，表示通过,或者拒绝')->default(0)->after('checked_at');
            $table->string('checked_note')->comment('客户审核备注')->nullable()->after('check_status_id');
            $table->integer('confirm_id')->comment('确认人id')->nullable();
            $table->timestamp('confirmed_at')->comment('确认时间')->nullable();
            $table->string('confirmed_note')->comment('确认备注')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'check_status_id',
                'checked_note',
                'confirm_id',
                'confirmed_at',
                'confirmed_note'
                ]);
        });
    }
}
