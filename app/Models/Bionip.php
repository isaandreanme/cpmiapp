<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bionip extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'pengalaman' => 'json'
    ];

    // KONEKSI-----------------------------------------------------------
    public function Pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function Tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }
    public function Status()
    {
        return $this->belongsTo(Status::class);
    }
    public function Marketing()
    {
        return $this->belongsTo(Marketing::class);
    }
    public function Sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
    public function Agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function Kantor()
    {
        return $this->belongsTo(Kantor::class);
    }
    public function Pengalaman()
    {
        return $this->belongsTo(Pengalaman::class);
    }
    public function Regency()
    {
        return $this->belongsTo(Regency::class);
        return $this->hasMany(Regency::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
