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
        Schema::create('cutidetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuti_id');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('cuti_id')->references('id')->on('cutis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutidetails');
    }
};
