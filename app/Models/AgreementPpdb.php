<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgreementPpdb extends Model
{
    protected $table = "agreement_ppdb";
    protected $fillable = [
        "id_periode",
        "created_by",
        "content",
    ];
    public function periode()
    {
        return $this->belongsTo(PeriodePpdb::class, 'id_periode');
    }

    public function user()
    {
        return $this->belongsTo(User::class, "created_by");
    }
}
