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
            // 'sub_category_id',
            // 'name',
            // 'inc_date',
            // 'inc_number',
            // 'country_id',
            // 'industry_id',
            // 'tax_number',
            // 'website',
            // 'telephone',
            // 'email',
            // 'additional_info',
            // 'remark'
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
