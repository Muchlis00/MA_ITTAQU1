<?php

namespace App\Http\Controllers;

use App\Models\PeriodePPDB;
use Illuminate\Http\Request;
use App\Models\Orientasi;
use Illuminate\Support\Facades\Auth;

class OrientasiController extends Controller
{
    public function index()
    {
        $orientasi = Orientasi::with(['creator', 'periode'])->get();
        return view('orientasi.index', compact('orientasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_periode' => 'required',
            'datetime_start' => 'required',
            'datetime_end' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
        ]);
        Orientasi::create([
            'id_periode' => $request->id_periode,
            'datetime_start' => $request->datetime_start,
            'datetime_end' => $request->datetime_end,
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::id(),
        ]);
        return redirect()->route('orientasi.index')->with('success', 'Informasi orientasi berhasil ditambahkan.');
    }

    // public function show(Orientasi $orientasi)
    // {
    //     return view('orientasi.show', compact('orientasi'));
    // }

    public function create()
    {
        $periodePPDB = PeriodePPDB::all();
        return view('orientasi.create', compact('periodePPDB'));
    }

    public function edit($id, Orientasi $orientasi)
    {
        $orientasi = Orientasi::find($id);
        $periodePPDB = PeriodePPDB::all();
        return view('orientasi.edit', compact('orientasi', 'periodePPDB'));
    }

    public function update( $id, Request $request)
    {
        $request->validate([
            'id_periode' => 'required',
            'datetime_start' => 'required',
            'datetime_end' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
        ]);
        $orientasi = Orientasi::find($id);
        $orientasi->update([
            'id_periode' => $request->id_periode,
            'datetime_start' => $request->datetime_start,
            'datetime_end' => $request->datetime_end,
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('orientasi.index')->with('success', 'Informasi orientasi berhasil diperbarui.');
    }

    public function delete($id,Orientasi $orientasi)
    {
        $orientasi = Orientasi::find($id)->first();
        $orientasi->delete();
        return redirect()->route('orientasi.index')->with('success', 'Informasi orientasi berhasil dihapus.');
    }
}
