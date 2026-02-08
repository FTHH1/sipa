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
        Schema::create('alat', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('nama_alat');
            $table->text('deskripsi_alat');
            $table->unsignedBigInteger('id_kategori');
            $table->timestamps();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
