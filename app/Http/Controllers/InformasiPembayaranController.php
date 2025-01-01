<?php

namespace App\Http\Controllers;

use App\Models\InformasiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PeriodePPDB;

class InformasiPembayaranController extends Controller
{
    public function index()
    {
        $periodePPDB = PeriodePPDB::all();
        return view('informasi-pembayaran.index', compact('periodePPDB'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|exists:periode_ppdb,id_periode',
            'detail_pembayaran' => 'required',
        ]);
        InformasiPembayaran::updateOrCreate([
            'id_periode' => $request->id_periode
        ], [
            'id_periode' => $request->id_periode,
            'detail_pembayaran' => $request->detail_pembayaran,
            'created_by' => Auth::id(),
        ]);
        return redirect()->route('informasi-pembayaran.index')->with('success', 'Informasi Pembayaran berhasil ditambahkan.');
    }
    public function show($id)
    {
        $InformasiPembayaran = InformasiPembayaran::where('id_periode', $id)->first();
        return response()->json($InformasiPembayaran);
    }
}
