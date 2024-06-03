<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    // ----------------------------------------------------------------
    protected static ?string $recordTitleAttribute = 'nama';
    // ----------------------------------------------------------------
    public function Province()
    {
        return $this->belongsTo(Province::class);
        return $this->hasMany(Province::class);
    }
    public function Regency()
    {
        return $this->belongsTo(Regency::class);
        return $this->hasMany(Regency::class);
    }
    public function District()
    {
        return $this->belongsTo(District::class);
        return $this->hasMany(District::class);
    }
    public function Village()
    {
        return $this->belongsTo(Village::class);
        return $this->hasMany(Village::class);
    }

    //----------------------------------------------------------------

    public function Kantor()
    {
        return $this->belongsTo(Kantor::class);
    }
    public function Sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
    public function DataPmi()
    {
        return $this->hasMany(DataPmi::class);
    }
}
