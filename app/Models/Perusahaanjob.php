<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'posisi',
        'deskripsi',
        'lokasi',
        'gaji',
        'tanggal_tutup',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
    
}
