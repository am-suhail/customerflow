<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserDetailTableAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('street')->nullable()->after('area_id');
            $table->string('area')->nullable()->after('area_id');
            $table->unsignedBigInteger('city_id')->nullable()->after('area_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('country_id')->nullable()->after('dob');
            $table->string('sex')->nullable()->after('dob');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            //
        });
    }
}
