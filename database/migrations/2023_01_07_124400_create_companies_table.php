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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('name')
                ->nullable();
            $table->date('inc_date')
                ->nullable();
            $table->string('inc_number')
                ->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('industry_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('tax_number')
                ->nullable();
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
