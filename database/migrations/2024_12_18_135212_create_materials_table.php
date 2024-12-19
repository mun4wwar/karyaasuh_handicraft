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
        Schema::create('materials', function (Blueprint $table) {
            $table->id('id_bahanbaku');
            $table->string('nama_bahan');
            $table->integer('jumlah_bahan');
            $table->enum('satuan', ['gram', 'meter', 'kilogram', 'kodi']);
            $table->decimal('harga_bahan', 10, 2);
            $table->decimal('total_hargabahan', 12, 2)->virtualAs('harga_bahan * jumlah_bahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
