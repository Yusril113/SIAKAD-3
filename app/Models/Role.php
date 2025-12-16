<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    /**
     * Relasi: satu role bisa punya banyak user
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}