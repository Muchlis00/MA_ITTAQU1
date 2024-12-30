<?php

namespace App\Http\Controllers;

use App\Models\AgreementPpdb;
use App\Models\PeriodePPDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgreementPPDBController extends Controller
{
    public function index()
    {
        $periodePPDB = PeriodePPDB::all();
        return view('agreement.index', compact('periodePPDB'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|exists:periode_ppdb,id_periode',
            'content' => 'required',
        ]);
        AgreementPpdb::updateOrCreate([
            'id_periode' => $request->id_periode
        ], [
            'id_periode' => $request->id_periode,
            'content' => $request->content,
            'created_by' => Auth::id(),
        ]);
        return redirect()->route('agreement.index')->with('success', 'Informasi Pembayaran berhasil ditambahkan.');
    }
    public function show($id)
    {
        $InformasiPembayaran = AgreementPpdb::where('id_periode', $id)->first();
        return response()->json($InformasiPembayaran);
    }
}
