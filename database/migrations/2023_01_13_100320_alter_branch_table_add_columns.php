<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->decimal('warehouse_rent', 15, 2)
                ->nullable()
                ->after('building_size');
            $table->integer('total_warehouse')
                ->nullable()
                ->after('building_size');
            $table->decimal('accomodation_rent', 15, 2)
                ->nullable()
                ->after('building_size');
            $table->integer('total_accomodation')
                ->nullable()
                ->after('building_size');

            $table->decimal('rent', 15, 2)
                ->nullable()
                ->after('building_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            //
        });
    }
};