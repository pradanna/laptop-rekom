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
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', [
                'menunggu pembayaran',
                'menunggu konfirmasi pembayaran',
                'pembayaran ditolak',
                'diproses',
                'dikirim',
                'selesai',
            ])->default('menunggu pembayaran')->change();

            // Tambah kolom proof (nullable dulu, diisi setelah user upload)
            $table->string('proof')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('status')->default('diproses')->change();
            $table->dropColumn('proof');
        });
    }
};
