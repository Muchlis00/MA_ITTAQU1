<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDiriPendaftar extends Model
{
    use HasFactory;

    protected $table = 'data_diri_pendaftar';

    protected $fillable = [
        'user_id',
        'telepon',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'nisn',
        'asal_sekolah',
        'alamat_sekolah_asal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wali()
    {
        return $this->hasMany(WaliPendaftar::class, 'pendaftar_id');
    }
}
