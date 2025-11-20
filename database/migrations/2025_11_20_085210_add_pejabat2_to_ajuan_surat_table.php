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
        Schema::table('tabel_ajuan_surat', function (Blueprint $table) {
            // Tambahkan kolom untuk pejabat kedua (nullable/boleh kosong)
            $table->unsignedBigInteger('id_pejabat_desa_2')->nullable()->after('id_pejabat_desa');

            // Tambahkan foreign key
            $table->foreign('id_pejabat_desa_2')->references('id_pejabat_desa')->on('tabel_pejabat_desa')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_ajuan_surat', function (Blueprint $table) {
            $table->dropForeign(['id_pejabat_desa_2']);
            $table->dropColumn('id_pejabat_desa_2');
        });
    }
};