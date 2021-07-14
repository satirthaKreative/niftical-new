<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->text('product_name');
            $table->float('product_price',10,2);
            $table->text('product_short_description')->nullable();
            $table->longText('product_full_description')->nullable();
            $table->longText('product_additional_information')->nullable();
            $table->string('product_unique_code');
            $table->bigInteger('product_stock')->default(0);
            $table->longText('product_thumbnail');
            $table->enum('product_available_status',['available','outofstock'])->default('available');
            $table->enum('admin_status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('product_tbls');
    }
}
