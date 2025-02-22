<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use App\Models\Orientasi;

class StatusPendaftaranController extends Controller
{
    private function isUserVerified()
    {
        $formulir = PendaftarPpdb::where('user_id', Auth::user()->id)->where('verification_status', 'verified')->exists();
        $pembayaran = PembayaranPpdb::where('id', Auth::user()->id)
            ->where('verification_status', 'verified')
            ->exists();
        if ($formulir && $pembayaran) {
            return true;
        } else {
            return false;
        }
    }
    public function index()
    {
        $pendaftarPPDB = PendaftarPpdb::where('user_id', Auth::user()->id)->with('periode')->first();
        $pembayaranPPDB = PembayaranPpdb::where('user_id', Auth::user()->id)->get();
        $orientasi = Orientasi::where('id_periode', $pendaftarPPDB->id_periode)->get();
        $isVerified = $this->isUserVerified();

        return view('status-pendaftaran.index', compact('pendaftarPPDB', 'pembayaranPPDB', 'orientasi', 'isVerified'));
    }
}
