<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->decimal('unit_price', 10, 2)
                ->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('discount', 10, 2)
                ->nullable();
            $table->integer('tax')
                ->nullable();
            $table->decimal('total', 10, 2)
                ->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
}
