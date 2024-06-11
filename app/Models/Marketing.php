<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function DataPmi()
    {
        return $this->hasMany(DataPmi::class);
    }
    public function Pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
    public function Biodata()
    {
        return $this->hasMany(Biodata::class);
    }
    public function Bionip()
    {
        return $this->hasMany(Bionip::class);
    }
}
