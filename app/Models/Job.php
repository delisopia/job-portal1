<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'posisi',
        'perusahaan',
        'deskripsi',
        'lokasi',
        'tanggal_tutup',
        'is_active',
        'gaji_min',
        'gaji_max',
        'tipe_kerja',
        'pengalaman',
        'perusahaan_id', // id perusahaan yang buat lowongan
        'perusahaan_job_id', // id dari tabel perusahaan_jobs jika ada
    ];

    protected $casts = [
        'tanggal_tutup' => 'date',
        'gaji_min' => 'decimal:2',
        'gaji_max' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relasi ke perusahaan
    public function perusahaan()
{
    return $this->belongsTo(Perusahaan::class);
}


    // Relasi ke pelamar
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

     // Relasi ke perusahaan_jobs
     public function perusahaanJob()
     {
         return $this->belongsTo(PerusahaanJob::class, 'perusahaan_job_id');
     }

    // Status aktif
    public function isActive()
    {
        return $this->is_active && $this->tanggal_tutup >= now()->format('Y-m-d');
    }

    // Rentang gaji
    public function getSalaryRangeAttribute()
    {
        if ($this->gaji_min && $this->gaji_max) {
            return 'Rp ' . number_format($this->gaji_min, 0, ',', '.') . ' - Rp ' . number_format($this->gaji_max, 0, ',', '.');
        }
        return 'Negotiable';
    }
}
