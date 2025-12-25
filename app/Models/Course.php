<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- BARIS INI DITAMBAHKAN

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'credits',
        'description',
        'program_study_id',
    ];

    /**
     * Relasi ke Class Offering (Kelas yang Ditawarkan).
     */
    public function classOfferings(): HasMany
    {
        return $this->hasMany(ClassOffering::class);
    }
    
    /**
     * Relasi opsional: Jika Mata Kuliah terikat pada Program Studi.
     */
    public function programStudy(): BelongsTo
    {
        // Pastikan Model ProgramStudy.php ada dan di-import jika berada di namespace berbeda
        return $this->belongsTo(ProgramStudy::class); 
    }
}