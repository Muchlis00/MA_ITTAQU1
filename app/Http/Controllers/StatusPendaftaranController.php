<?php

namespace App\Http\Controllers;

use App\Models\DataDiriPendaftar;
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use App\Models\Orientasi;
use App\Models\PeriodePPDB;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StatusPendaftaranController extends Controller
{
    private function isUserVerified()
    {
        $formulir = PendaftarPpdb::where('user_id', Auth::user()->id)
            ->where('verification_status', 'verified')
            ->exists();

        $pembayaran = PembayaranPpdb::where('user_id', Auth::user()->id)
            ->where('verification_status', 'verified')
            ->exists();

        return $formulir && $pembayaran;
    }
    public function index()
    {
        $pendaftarPPDB = PendaftarPpdb::where('user_id', Auth::user()->id)->with('periode')->first();
        $pembayaranPPDB = PembayaranPpdb::where('user_id', Auth::user()->id)->get();
        $orientasi = Orientasi::where('id_periode', $pendaftarPPDB->id_periode)->get();
        $isVerified = $this->isUserVerified();

        return view('status-pendaftaran.index', compact('pendaftarPPDB', 'pembayaranPPDB', 'orientasi', 'isVerified'));
    }
   public function tandaBukti()
{
    $user = Auth::user();
    $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
    $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first();
    $kepsek = User::where('role','kepsek')->first();
    
    return view('status-pendaftaran.tandaBukti', compact('user','currentPeriode','currentDataDiriPendaftar','kepsek'));
    
}

}