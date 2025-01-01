<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranPpdb extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_ppdb';

    protected $fillable = [
        'id_periode',
        'user_id',
        'verifier_id',
        'verification_status',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodePpdb::class, 'id_periode');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verifier_id');
    }
}