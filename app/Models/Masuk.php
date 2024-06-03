<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function BukuKas()
    {
        return $this->belongsTo(BukuKas::class);
        return $this->hasMany(BukuKas::class);

    }
}
