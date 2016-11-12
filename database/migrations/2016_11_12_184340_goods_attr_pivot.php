<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsAttrPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attr_value', 50)->default('');
            $table->decimal('attr_price')->default(0);

            $table->integer('goods_id')->unsigned()->index();
            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('attribute_id')->unsigned()->index();
            $table->foreign('attribute_id')->references('id')->on('attributes')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_attribute');
    }
}
