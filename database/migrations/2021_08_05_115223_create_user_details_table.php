<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('referral_code')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->date('dob')->nullable();
            $table->string('sex')->nullable();
            $table->string('national_id')->nullable();
            $table->date('national_id_expiry')->nullable();
            $table->string('tax_id')->nullable();
            $table->date('tax_id_expiry')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('passport')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('building_name')->nullable();
            $table->foreignId('city_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('street_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('street_text')->nullable();
            $table->foreignId('area_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('area_text')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('qualification_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->integer('years_of_exp')->nullable();
            $table->json('additional_info')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
