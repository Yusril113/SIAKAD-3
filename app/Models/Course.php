<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    public function classOfferings(): HasMany
    {
        return $this->hasMany(ClassOffering::class);
    }
}