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
        if (!Schema::hasTable('class_offerings')) {
            Schema::create('class_offerings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained()->cascadeOnDelete();
                $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();
                $table->foreignId('semester_id')->constrained()->cascadeOnDelete();
                $table->string('section')->nullable(); // Kelas A/B
                $table->boolean('attendance_open')->default(false); // window presensi
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_offerings');
    }
};
