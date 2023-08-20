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
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreignId('revenue_type_id')
                ->nullable()
                ->after('category_id')
                ->constrained()
                ->nullOnDelete();
        });

Schema::create('product_suppliers', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();
    $table->foreignId('supplier_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();
    $table->decimal('purchase_price', 10, 2)
        ->default(0.00);
    $table->boolean('is_default')
        ->default(0);
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
        Schema::table('sub_categories', function (Blueprint $table) {
            //
        });
    }
};
