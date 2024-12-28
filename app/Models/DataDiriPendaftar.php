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
        'gender',
        'place_of_birth',
        'date_of_birth',
        'nisn',
        'phone',
        'child_number',
        'sibling',
        'previous_school_name',
        'previous_school_address',
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
