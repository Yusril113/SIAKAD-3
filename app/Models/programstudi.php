<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudy extends Model
{
    use HasFactory;
    
    // Nama tabel: 'program_studies' (default Laravel)

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code', // e.g., 'IF', 'SI', 'MNJ'
        'description',
        // Anda bisa menambahkan kolom 'head_of_study_program_id' jika perlu
    ];

    /**
     * Relasi ke Mata Kuliah (Courses).
     * Satu Program Studi memiliki banyak Mata Kuliah.
     */
    public function courses(): HasMany
    {
        // Asumsi kunci asing di tabel 'courses' adalah 'program_study_id'
        return $this->hasMany(Course::class);
    }
    
    /**
     * Relasi ke Mahasiswa (Students).
     * Satu Program Studi memiliki banyak Mahasiswa.
     */
    public function students(): HasMany
    {
        // Asumsi kunci asing di tabel 'students' adalah 'program_study_id'
        return $this->hasMany(Student::class);
    }
}