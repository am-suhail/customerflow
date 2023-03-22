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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('number')
                ->nullable();
            $table->foreignId('branch_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->date('document_date')
                ->nullable();
            $table->date('accounting_date')
                ->nullable();
            $table->decimal('amount', 12, 2)
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->json('additional_info')
                ->nullable();
            $table->text('remark')
                ->nullable();
            $table->integer('type')
                ->default(1);
            $table->integer('status')
                ->default(1);
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
        Schema::dropIfExists('expenses');
    }
};
