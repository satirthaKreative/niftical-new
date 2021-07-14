<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cart_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('user_ip')->nullable();
            $table->integer('product_id')->default(0);
            $table->string('product_name')->nullable();
            $table->integer('additional_product_id')->dafault(0);
            $table->float('product_price',8,2);
            $table->integer('product_quantity')->default(0);
            $table->enum('admin_action',['active','inactive'])->default('active');
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
        Schema::dropIfExists('order_details');
    }
}
