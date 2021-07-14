<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingAddressTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_address_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('country_name');
            $table->longText('street_one')->nullable();
            $table->longText('street_two')->nullable();
            $table->string('city_name')->nullable();
            $table->string('zip_code')->nullable();
            $table->bigInteger('phone_num')->nullable();
            $table->text('email_address')->nullable();
            $table->enum('admin_action',['yes','no'])->default('yes');
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
        Schema::dropIfExists('billing_address_tbl');
    }
}
