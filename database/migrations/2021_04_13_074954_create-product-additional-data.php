<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAdditionalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_additional_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->text('product_customize_name');
            $table->longText('product_customize_link');
            $table->string('user_ip',100);
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('product_additional_tbl');
    }
}
