<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'cv_path'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPerusahaan()
{
    return $this->role === 'perusahaan';
}


    public function jobs()
    {
        return $this->hasMany(Job::class, 'perusahaan_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function perusahaan()
{
    return $this->belongsTo(Perusahaan::class);
}

}