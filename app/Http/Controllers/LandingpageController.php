<?php

namespace App\Http\Controllers;
use App\Models\AgreementPpdb;
use App\Models\InformasiPembayaran;
use App\Models\PeriodePPDB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function welcome()
    {
        $currentDate = Carbon::now();
        $activePeriod = PeriodePPDB::with(['detail_pembayaran', 'agreement','orientasi'])
                        ->where('startDate', '<=', $currentDate)
                                 ->where('endDate', '>=', $currentDate)
                                 ->first();
        
        return view('welcome', [
            'isPeriodActive' => $activePeriod ? true : false,
            'activePeriod' => $activePeriod,
            'informasiPembayaran' => $activePeriod?->detail_pembayaran->first()?->detail_pembayaran ?? null,
            'agreementContent' => $activePeriod?->agreement->first()?->content ?? null,
            'orientasi' => $activePeriod?->orientasi ?? collect()
        ]);
    }
}
