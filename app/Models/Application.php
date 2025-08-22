<?php
// app/Models/Application.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 'user_id', 'nama', 'email', 'telepon', 'alamat', 'cv_path', 'status', 'applied_at'
    ];

    protected function casts(): array
    {
        return [
            'applied_at' => 'datetime',
        ];
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mapping untuk badge Bootstrap
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'reviewed' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger'
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    // Mapping status database ke bahasa Indonesia
    const STATUS_MAP = [
        'pending'  => 'menunggu',
        'reviewed' => 'direview',
        'accepted' => 'diterima',
        'rejected' => 'ditolak',
    ];

    // Accessor untuk menampilkan status bahasa Indonesia
    public function getStatusLabelAttribute()
    {
        return self::STATUS_MAP[$this->status] ?? $this->status;
    }

    // Fungsi helper untuk update status via label bahasa Indonesia
    public static function setStatusByLabel($id, $label)
    {
        $key = array_search($label, self::STATUS_MAP);
        if ($key) {
            self::where('id', $id)->update(['status' => $key]);
        }
    }
}
