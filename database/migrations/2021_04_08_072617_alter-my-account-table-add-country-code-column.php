<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMyAccountTableAddCountryCodeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accountfulltbl', function (Blueprint $table) {
            //
            $table->smallinteger('country_phone_num')->after('phone_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accountfulltbl', function (Blueprint $table) {
            //
        });
    }
}
