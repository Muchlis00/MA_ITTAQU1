<?php

namespace App\Http\Controllers;

use App\Models\InformasiPembayaran;
use App\Models\DataDiriPendaftar;
use App\Models\PembayaranPpdb;
use App\Models\PendaftarPpdb;
use App\Models\User;
use App\Models\WaliPendaftar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PeriodePPDB;
use Dflydev\DotAccessData\Data;
use stdClass;
use Illuminate\Http\JsonResponse;


class InformasiPembayaranController extends Controller
{
    public function index(){
        $periodePPDB = PeriodePPDB::all();
        return view('informasi-pembayaran.index', compact('periodePPDB'));
    }

    public function store(Request $request){}
    public function show($id){
        $InformasiPembayaran = InformasiPembayaran::find($id) ?? new InformasiPembayaran;
        return response()->json($InformasiPembayaran);
    }
}
