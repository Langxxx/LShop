<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->tinyInteger('type')->unsigned()->default(0)->comment('属性的类型, 0唯一|1可选');
            $table->string('option_value', 150)->default('')->comment('属性可选值,多个用,隔开');

            $table->integer('type_id')->unsigned()->index()->comment('属性所属商品类型');
            $table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attributes');
    }
}
