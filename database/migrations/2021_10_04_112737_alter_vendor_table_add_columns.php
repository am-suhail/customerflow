<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVendorTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->unsignedBigInteger('industry_id')->nullable()->after('vat');
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->string('street')->nullable()->after('area_id');
            $table->string('area')->nullable()->after('area_id');
            $table->unsignedBigInteger('city_id')->nullable()->after('area_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('website')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropIndex(['industry_id']);
            $table->dropColumn('industry_id');
            $table->dropColumn('street');
            $table->dropColumn('area');
            $table->dropIndex(['city_id']);
            $table->dropColumn('city_id');
            $table->dropColumn('website');
        });
    }
}
