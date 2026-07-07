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
            'detail_pembayaran' => 'nullable|string',
            'biaya_administrasi' => 'nullable|array',
            'biaya_administrasi.*.nama' => 'required|string|max:255',
            'biaya_administrasi.*.jumlah' => 'required|numeric|min:0',
            'biaya_atribut' => 'nullable|array',
            'biaya_atribut.*.nama' => 'required|string|max:255',
            'biaya_atribut.*.putra' => 'required|numeric|min:0',
            'biaya_atribut.*.putri' => 'required|numeric|min:0',
            'minimal_pembayaran_pertama' => 'required|integer|min:0|max:100',
            'potongan_lunas' => 'required|numeric|min:0',
        ]);

        InformasiPembayaran::updateOrCreate([
            'id_periode' => $request->id_periode
        ], [
            'id_periode' => $request->id_periode,
            'detail_pembayaran' => $request->detail_pembayaran ?? '',
            'biaya_administrasi' => $request->biaya_administrasi ?? [],
            'biaya_atribut' => $request->biaya_atribut ?? [],
            'minimal_pembayaran_pertama' => $request->minimal_pembayaran_pertama,
            'potongan_lunas' => $request->potongan_lunas,
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
