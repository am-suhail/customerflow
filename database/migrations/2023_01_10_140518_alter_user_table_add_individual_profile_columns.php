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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('remarks');
            $table->dropColumn('profile');

            $table->boolean('investor')
                ->default(0)
                ->after('password');

            $table->boolean('director')
                ->default(0)
                ->after('password');

            $table->boolean('kmp')
                ->default(0)
                ->after('password');

            $table->boolean('affiliate')
                ->default(0)
                ->after('password');

            $table->boolean('employee')
                ->default(0)
                ->after('password');

            $table->boolean('admin')
                ->default(0)
                ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
