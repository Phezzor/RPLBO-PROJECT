<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('pengguna', function (Blueprint $table) {
        if (!Schema::hasColumn('pengguna', 'status')) {
            $table->string('status', 20)->default('active')->after('role');
        }
    });

    Schema::table('produk', function (Blueprint $table) {
        if (!Schema::hasColumn('produk', 'status')) {
            $table->string('status', 20)->default('active')->after('created_at');
        }
    });

    Schema::table('cabang', function (Blueprint $table) {
        if (!Schema::hasColumn('cabang', 'status')) {
            $table->string('status', 20)->default('active')->after('created_at');
        }
    });
}


    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('cabang', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
