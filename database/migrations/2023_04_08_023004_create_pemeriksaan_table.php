<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profile_id')->nullable();

            $table->date('tgl_pemeriksaan')->nullable();

            $table->string('tekanan_darah')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('lila')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->text('keluhan')->nullable();


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
