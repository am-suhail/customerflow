<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->json('languages')->nullable();
            $table->string('company_name')->nullable();
            $table->foreignId('industry_id')->nullable()->constrained();
            $table->string('email')->nullable();
            $table->string('mobile')->unique();
            $table->string('landline')->nullable();
            $table->string('alternate_number')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('area')->nullable();
            $table->string('street')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->date('date')->nullable();
            $table->foreignId('sub_category_id')->nullable()->constrained();
            $table->foreignId('service_id')->nullable()->constrained();
            $table->boolean('demo_presented')->default(1);
            $table->longText('feedback')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('market_leads');
    }
}
