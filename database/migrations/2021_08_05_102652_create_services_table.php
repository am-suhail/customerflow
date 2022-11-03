<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->foreignId('sub_category_id')
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('unit_id')
                ->constrained()
                ->nullOnDelete();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('cost_one', 10, 2)->nullable();
            $table->text('cost_one_desc')->nullable();
            $table->decimal('cost_two', 10, 2)->nullable();
            $table->text('cost_two_desc')->nullable();
            $table->text('description')->nullable();
            $table->json('additional_info')->nullable();
            $table->integer('type')->default(1);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('services');
    }
}
