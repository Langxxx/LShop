<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_stocks', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedTinyInteger('number');
            $table->string('goods_attr_id')->index()->comment('存放goods_attribute表中的id的组合,id之间用升序排列');
            $table->unsignedInteger('goods_id')->index();
            $table->foreign('goods_id')->references('id')->on('goods')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_stocks');
    }
}
