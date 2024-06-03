<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKas extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    
    
    public function Masuk()
    {
        return $this->hasMany(Masuk::class);
    }
    public function Keluar()
    {
        return $this->hasMany(Keluar::class);
    }
}
