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
        Schema::create('program_studies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama Program Studi (e.g., Teknik Informatika)
            $table->string('code', 10)->unique(); // Kode Program Studi (e.g., IF)
            $table->text('description')->nullable();
            
            // Kolom untuk Kepala Program Studi (Opsional)
            // $table->foreignId('head_of_study_program_id')->nullable()->constrained('lecturers'); 
            
            $table->timestamps();
        });
        
        // Tambahkan Foreign Key di tabel 'courses' (Jika belum ada)
        Schema::table('courses', function (Blueprint $table) {
            // Drop column jika sudah ada, atau tambahkan jika belum
            if (!Schema::hasColumn('courses', 'program_study_id')) {
                $table->foreignId('program_study_id')->nullable()->constrained('program_studies')->after('credits');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dari courses sebelum menghapus tabel program_studies
        if (Schema::hasColumn('courses', 'program_study_id')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropForeign(['program_study_id']);
                $table->dropColumn('program_study_id');
            });
        }

        Schema::dropIfExists('program_studies');
    }
};