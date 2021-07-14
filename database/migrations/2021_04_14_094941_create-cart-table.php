<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(0);
            $table->integer('product_id');
            $table->text('product_name');
            $table->integer('additional_product_id')->default('0');
            $table->float('product_price',8,2);
            $table->integer('product_quantity');
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
        Schema::dropIfExists('cart_tbls');
    }
}
