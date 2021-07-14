<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner_heading_quote')->nullable();
            $table->string('banner_heading_name')->nullable();
            $table->longText('banner_paragraph')->nullable();
            $table->longText('banner_img')->nullable();
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
        Schema::dropIfExists('banner_tbl');
    }
}
