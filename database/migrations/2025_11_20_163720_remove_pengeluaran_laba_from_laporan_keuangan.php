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
    // Postgres perlu raw SQL untuk drop column if exists
    DB::statement('ALTER TABLE laporan_keuangan DROP COLUMN IF EXISTS laba_bersih');
    DB::statement('ALTER TABLE laporan_keuangan DROP COLUMN IF EXISTS total_pengeluaran');
}


public function down(): void
{
    Schema::table('laporan_keuangan', function (Blueprint $table) {
        $table->decimal('total_pengeluaran', 12, 2)->default(0);
        $table->decimal('laba_bersih', 12, 2)->storedAs('total_pendapatan - total_pengeluaran');
    });
}


};
