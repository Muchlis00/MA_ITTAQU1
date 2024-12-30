<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePPDB extends Model
{
    use HasFactory;
    protected $table = 'periode_ppdb';
    protected $primaryKey = 'id_periode';
    protected $fillable = [
        'name',
        'startDate',
        'endDate',
        'panitia'
    ];
    public function panitia()
    {
        return $this->belongsToMany(User::class, 'panitia_ppdb', 'id_periode', 'user_id')
            ->withPivot('id');
    }
    public function bendahara()
    {
        return $this->belongsToMany(User::class, 'bendahara_ppdb', 'id_periode', 'user_id')
            ->withPivot('id')
            ->withTimestamps();
    }

    // Relationship with pembayaran_ppdb
    public function pembayaran()
    {
        return $this->hasMany(PembayaranPPDB::class, 'id_periode', 'id_periode');
    }

    // Relationship with pendaftar_ppdb
    public function pendaftar()
    {
        return $this->hasMany(PendaftarPPDB::class, 'id_periode', 'id_periode');
    }

    public function detail_pembayaran()
    {
        return $this->hasMany(informasi_pembayaran::class, 'id_periode', 'id_periode');
    }
}
