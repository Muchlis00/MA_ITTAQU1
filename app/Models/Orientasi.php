<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orientasi extends Model
{
    protected $table = 'orientasi';
    // The attributes that are mass assignable.
    protected $fillable = [
        'datetime_start',
        'datetime_end',
        'kegiatan',
        'keterangan',
        'created_by',
        'id_periode',
    ];

    /**
     * Get the user that created the orientasi.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the periode associated with the orientasi.
     */
    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodePpdb::class, 'id_periode');
    }
}
