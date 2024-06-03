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
        Schema::table('masuks', function (Blueprint $table) {
            $table->unsignedBigInteger('buku_kas_id')
            ->nullable();
            $table->foreign('buku_kas_id')
            ->references('id')
            ->on('masuks')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masuks', function (Blueprint $table) {
            //
        });
    }
};
