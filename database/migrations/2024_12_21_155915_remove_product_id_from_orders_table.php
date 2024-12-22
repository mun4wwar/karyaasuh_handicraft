<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['product_id']);

            // Hapus kolom product_id
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan kembali kolom product_id dengan foreign key
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
