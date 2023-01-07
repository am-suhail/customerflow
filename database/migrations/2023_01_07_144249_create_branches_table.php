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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('name');
            $table->string('code');
            $table->string('mobile')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('branches');
    }
};
