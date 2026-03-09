<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDiriPendaftar extends Model
{
    use HasFactory;

    protected $table = 'data_diri_pendaftar';

    protected $casts = [
        'nilai_rapor' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'nisn',
        'phone',
        'domisili',
        'child_number',
        'sibling',
        'previous_school_name',
        'previous_school_address',
        'ijazah',
        'photo',
        'akte_kelahiran',
        'kip',
        'nilai_rapor',
        'rapor_semester_1',
        'rapor_semester_2',
        'rapor_semester_3',
        'rapor_semester_4',
        'rapor_semester_5',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wali()
    {
        return $this->hasMany(WaliPendaftar::class, 'data_diri_pendaftar_id');
    }
    
}
