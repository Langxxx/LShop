<?php

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
            $table->timestamp('create_at')->nullable();

            $table->string('shr_name', 30)->comment('收货人名称');
            $table->string('province', 30);
            $table->string('city', 30);
            $table->string('dist', 30);
            $table->string('tel', 30);
            $table->string('address', 30);

            $table->decimal('total_price');

            $table->string('post_method', 30);
            $table->string('pay_method', 30);

            $table->unsignedTinyInteger('pay_status')->defalut(0)->comment('支付状态0未支付，1已经支付');
            $table->unsignedTinyInteger('post_status')->defalut(0)->comment('发货状态0未发货，1已经收货');

            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('order_goods', function (Blueprint $table) {


            $table->string('goods_attr_id', 30);
            $table->string('goods_attr_str', 100);
            $table->decimal('goods_price');
            $table->unsignedInteger('goods_number');

            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('order_id')->index();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('orders');
        Schema::drop('order_goods');
    }
}
