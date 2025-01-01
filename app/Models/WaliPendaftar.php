<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliPendaftar extends Model
{
    use HasFactory;

    protected $table = 'wali_pendaftar';

    protected $fillable = [
        'data_diri_pendaftar_id', 
        'name',
        'address',
        'phone',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'pekerjaan',
        'pendapatan',
        'ktp',
        'kartu_keluarga',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(DataDiriPendaftar::class, 'data_diri_pendaftar_id');
    }
}
