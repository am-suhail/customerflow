<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained();
            $table->date('date');
            $table->decimal('total_discount', 10, 2)
                ->nullable();
            $table->decimal('total_tax', 10, 2)
                ->nullable();
            $table->decimal('total_amount', 10, 2)
                ->nullable();
            $table->json('additional_info')->nullable();
            $table->integer('type')->default(1);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('invoices');
    }
}
