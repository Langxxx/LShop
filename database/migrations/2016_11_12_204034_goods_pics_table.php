<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsPicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_pics', function (Blueprint $table) {
            $table->increments('id');

            $table->text('pic');
            $table->text('sm_pic');

            $table->integer('goods_id')->unsigned()->index();
            $table->foreign('goods_id')->references('id')->on('goods')
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
