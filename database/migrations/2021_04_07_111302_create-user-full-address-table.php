<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFullAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountFulltbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->bigInteger('phone_num');
            $table->timestamp('user_birth');
            $table->string('user_street');
            $table->string('user_city',100);
            $table->string('user_state',100);
            $table->string('user_state_code',10);
            $table->string('zipcode',10);
            $table->enum('admin_action',['yes','no'])->default('yes');
            $table->text('admin_comments')->nullable();
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
        Schema::dropIfExists('accountFulltbl');
    }
}
