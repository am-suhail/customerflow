<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('sex')
                ->nullable();
            $table->foreignId('nationality_id')
                ->nullable()
                ->constrained('countries')
                ->nullOnDelete();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->foreignId('industry_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->date('inc_date')
                ->nullable();
            $table->string('vat')
                ->nullable();
            $table->string('url')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('city_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('telephone')->nullable();
            $table->json('additional_info')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
