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
        Schema::table('transactions', function (Blueprint $table) {
            // Menambahkan kolom transaction_id
            $table->string('transaction_id')->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Menghapus kolom transaction_id jika migrasi dibatalkan
            $table->dropColumn('transaction_id');
        });
    }
};
