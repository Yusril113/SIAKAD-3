<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

// Pastikan semua model yang direlasikan sudah di-import
use App\Models\mahasiswa;
use App\Models\Lecturer; 
use App\Models\Role;     

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'active', // Tambahkan 'active' jika Anda menggunakannya di Controller
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // Tambahkan 'active' jika itu boolean di database
            // 'active' => 'boolean', 
        ];
    }

    // ===============================================
    // RELATIONS
    // ===============================================

    // Relasi ke Role (Dipanggil sebagai $user->role)
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke Student (Dipanggil sebagai $user->student)
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }

    // Relasi ke Lecturer (Dipanggil sebagai $user->lecturer)
    public function lecturer(): HasOne
    {
       return $this->hasOne(Lecturer::class);
    }

    // ===============================================
    // ACCESSOR (Penambahan Penting untuk Middleware & Redirect)
    // ===============================================
    
    /**
     * Accessor untuk mendapatkan nama peran (string).
     * Dapat dipanggil di kode sebagai $user->role_name
     */
    public function getRoleNameAttribute(): ?string
    {
        // Cek apakah relasi role ada, lalu ambil nama.
        return $this->role ? $this->role->name : null;
    }
}