<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'website',
    ];

/*************  ✨ Windsurf Command ⭐  *************/

    /**

/*******  fc1744a3-dc3b-4e9c-b2ee-401b42a807d4  *******/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(PerusahaanJob::class);
    }
}
