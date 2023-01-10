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
            $table->decimal('building_size', 15, 2)
                ->nullable()
                ->after('inc_date');

            $table->decimal('investment_shares', 18, 2)
                ->nullable()
                ->after('city_id');

            $table->decimal('investment_percentage', 18, 2)
                ->nullable()
                ->after('city_id');

            $table->decimal('investment_amount', 18, 2)
                ->nullable()
                ->after('city_id');

            $table->decimal('total_shares', 18, 2)
                ->nullable()
                ->after('city_id');

            $table->decimal('capital', 18, 2)
                ->nullable()
                ->after('city_id');
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
