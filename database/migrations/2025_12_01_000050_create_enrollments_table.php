<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk tabel enrollments.
     */
    public function up(): void
    {
        // Hapus tabel jika sudah ada sisa-sisa error sebelumnya
        Schema::dropIfExists('enrollments');

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            
            /**
             * PERBAIKAN KRUSIAL: 
             * Nama tabel di migrasi Anda adalah 'mahasiswa', bukan 'students'.
             * Jadi references('id')->on('mahasiswa') adalah yang benar.
             */
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                  ->references('id')
                  ->on('mahasiswa') // Harus sama dengan Schema::create('mahasiswa', ...)
                  ->onDelete('cascade');
            
            /**
             * Pastikan juga tabel 'class_offerings' namanya benar di migrasinya.
             * Jika nama tabelnya 'penawaran_kelas', ganti 'on' nya jadi 'penawaran_kelas'.
             */
            $table->unsignedBigInteger('class_offering_id');
            $table->foreign('class_offering_id')
                  ->references('id')
                  ->on('class_offerings') 
                  ->onDelete('cascade');
            
            $table->string('status')->default('mengambil')->index();
            $table->decimal('grade', 5, 2)->nullable();
            $table->text('remarks')->nullable();
            
            $table->unique(['student_id', 'class_offering_id'], 'unique_enrollment');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Batalkan migrasi (Rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};