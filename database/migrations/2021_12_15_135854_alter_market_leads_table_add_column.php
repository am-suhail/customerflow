<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMarketLeadsTableAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('market_leads', function (Blueprint $table) {
            $table->foreignId('follow_up_status_id')->nullable()->after('feedback')->constrained();
            $table->string('lead_type')->nullable()->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('market_leads', function (Blueprint $table) {
            //
        });
    }
}
