<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliPendaftar extends Model
{
    use HasFactory;

    protected $table = 'wali_pendaftar';

    protected $fillable = [
        'pendaftar_id',
        'nama',
        'alamat',
        'telepon',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'pendapatan',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(DataDiriPendaftar::class, 'pendaftar_id');
    }
}
