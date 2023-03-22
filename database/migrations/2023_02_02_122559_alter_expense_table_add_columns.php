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
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('document_number')
                ->nullable()
                ->after('document_date');

            $table->foreignId('entry_type_id')
                ->nullable()
                ->after('sub_category_id')
                ->constrained('transaction_entry_types')
                ->nullOnDelete();

            $table->foreignId('tax_option_id')
                ->nullable()
                ->after('amount')
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            //
        });
    }
};
