<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPembayaran extends Model
{
    protected $table = "informasi_pembayaran";
    protected $fillable = [
        "id_periode",
        "created_by",
        "detail_pembayaran"
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
