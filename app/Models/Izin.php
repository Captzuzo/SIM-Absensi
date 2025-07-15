<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'periode',
        'kedisiplinan',
        'kerja_sama',
        'catatan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
