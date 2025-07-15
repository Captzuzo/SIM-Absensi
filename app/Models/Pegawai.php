<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'role_id',
        'jenis_karyawan',
        'status',
        'tgl_masuk'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function absensis()
    {
        return $this->hasMany(\App\Models\Absensi::class);
    }

    public function izin()
    {
        return $this->hasMany(Izin::class);
    }

    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
