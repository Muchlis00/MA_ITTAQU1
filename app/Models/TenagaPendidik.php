<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaPendidik extends Model
{
    use HasFactory;
    protected $table = 'tenaga_pendidik';
    protected $primaryKey = 'id_pendidik';
    protected $fillable = [
        'id',
        'nip',
        'nama_guru',
        'tempat_guru',
        'tgl_guru',
        'jk_guru',
        'jabatan',
    ];
}
