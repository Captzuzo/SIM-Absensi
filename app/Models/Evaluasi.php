<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluasi extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'tgl_mulai',
        'tgl_selesai',
        'alasan',
        'status_izin' // pending, disetujui, ditolak
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
