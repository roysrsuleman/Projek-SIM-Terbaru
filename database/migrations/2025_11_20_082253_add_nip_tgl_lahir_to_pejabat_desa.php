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
        Schema::table('tabel_pejabat_desa', function (Blueprint $table) {
            $table->string('nip', 30)->nullable()->after('jabatan');
            $table->date('tanggal_lahir')->nullable()->after('nip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_pejabat_desa', function (Blueprint $table) {
            $table->dropColumn(['nip', 'tanggal_lahir']);
        });
    }
};