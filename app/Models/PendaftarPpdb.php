<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarPpdb extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_ppdb';

    protected $fillable = [
        'id_periode',
        'user_id',
        'ready_to_verify',
        'verification_status',
        'verifier_id',
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodePPDB::class, 'id_periode');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dataDiriPendaftar()
    {
        return $this->hasOne(DataDiriPendaftar::class, 'user_id', 'user_id');
    }
    public function wali()
    {
        return $this->hasManyThrough(
            WaliPendaftar::class,
            DataDiriPendaftar::class,
            'user_id',
            'data_diri_pendaftar_id',
            'user_id',
            'id'
        );
    }
}
