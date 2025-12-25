<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassOffering extends Model
{
    /**
     * The attributes that are mass assignable.
     * Ini harus sesuai dengan field yang divalidasi dan dikirim dari Controller.
     */
    protected $fillable = [
        'course_id',
        'lecturer_id',
        'semester_id',
        'capacity', // Field untuk batas jumlah mahasiswa
        // Tambahkan field lain jika ada, misalnya 'class_code', 'status', dll.
    ];

    /**
     * Relasi ke Model Mata Kuliah (Course).
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relasi ke Model Dosen (Lecturer).
     */
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    /**
     * Relasi ke Model Semester.
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * Relasi ke Enrollment (Mahasiswa yang mengambil kelas ini).
     */
    public function enrollments(): HasMany
    {
        // Pastikan Anda juga memiliki Model Enrollment.php
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relasi ke Schedule (Jadwal pertemuan untuk kelas ini).
     */
    public function schedules(): HasMany
    {
        // Pastikan Anda juga memiliki Model Schedule.php
        return $this->hasMany(Schedule::class);
    }
}