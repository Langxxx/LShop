<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', '50')->default('');

            $table->decimal('market_price')->default(0);
            $table->decimal('shop_price')->default(0)->index();

            $table->string('logo')->default('');
            $table->string('sm_logo')->default('');

            $table->longText('goods_desc')->default('');

            $table->unsignedTinyInteger('is_hot')->default(0)->index();
            $table->unsignedTinyInteger('is_new')->default(0)->index();
            $table->unsignedTinyInteger('is_best')->default(0)->index();
            $table->unsignedTinyInteger('is_on_sale')->default(0)->index();
            $table->unsignedTinyInteger('is_delete')->default(0)->index();

            $table->unsignedTinyInteger('sort_num')->default(0)->index();

            $table->unsignedInteger('type_id')->foreign('type_id')->references('id')->on('types')->onUpdate('cascade')
                ->onDelete('cascade')->index();
            $table->unsignedInteger('category_id')->foreign('category_id')->references('id')->on
            ('categories')->onUpdate('cascade')->onDelete('cascade')->index();
            $table->unsignedInteger('brand_id')->foreign('brand_id')->references('id')->on
            ('brands')->onUpdate('cascade')->onDelete('cascade')->index();


            $table->timestamp('created_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods');
    }
}
