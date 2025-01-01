<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaPpdb extends Model
{
    use HasFactory;

    protected $table = 'panitia_ppdb';

    protected $fillable = [
        'id_periode',
        'user_id',
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodePpdb::class, 'id_periode');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}