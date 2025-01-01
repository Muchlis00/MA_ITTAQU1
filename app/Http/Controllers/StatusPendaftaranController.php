<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use App\Models\Orientasi;

class StatusPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarPPDB = PendaftarPpdb::where('user_id', Auth::user()->id)->with('periode')->first();
        $pembayaranPPDB = PembayaranPpdb::where('user_id', Auth::user()->id)->get();
        $orientasi = Orientasi::where('id_periode', $pendaftarPPDB->id_periode)->get();

        return view('status-pendaftaran.index', compact('pendaftarPPDB', 'pembayaranPPDB', 'orientasi'));
    }
}
