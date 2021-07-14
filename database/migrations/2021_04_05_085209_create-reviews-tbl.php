<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->tinyInteger('review_start_count');
            $table->string('customer_name',150);
            $table->longText('customer_msg');
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
        Schema::dropIfExists('reviews_tbl');
    }
}
