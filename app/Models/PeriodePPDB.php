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
        return $this->belongsToMany(User::class, 'panitia_ppdb', 'id_periode', 'user_id');
    }
}
