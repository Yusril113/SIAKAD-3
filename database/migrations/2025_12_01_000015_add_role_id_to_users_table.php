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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                // $table->foreignId('role_id') akan otomatis membuat kolom ini non-nullable, 
                // yang sesuai dengan error yang Anda hadapi (kolom wajib diisi)
                $table->foreignId('role_id')->constrained()->onDelete('cascade')->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['role_id']); 
            
            // Hapus kolom 'role_id'
            $table->dropColumn('role_id');
        });
    }
};