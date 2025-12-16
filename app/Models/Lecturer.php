<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecturer extends Model
{
    use HasFactory;

    /**
     * Kolom yang diizinkan untuk Mass Assignment.
     * HARUS menambahkan 'user_id'.
     */
    protected $fillable = [
        'user_id', 
        'nidn',// <<< Tambahkan ini
        // Tambahkan kolom lain jika ada (misalnya: 'nidn', 'expertise')
    ];

    // Jika Anda menggunakan timestamps (created_at, updated_at)
    // public $timestamps = true; 

    /**
     * Relasi dengan Model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}