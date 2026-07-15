<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodePPDB;
use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use App\Models\User;
use App\Exports\PendaftarPpdbExport;
use Maatwebsite\Excel\Facades\Excel;

class PeriodePPDBController extends Controller
{
    public function index()
    {
        $periodePPDB = PeriodePPDB::all();
        $keys = ['id', 'nama', 'mulai', 'selesai', 'action','status'];

        return view('periode-ppdb.index', compact('periodePPDB', 'keys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $overlappingPeriods = PeriodePPDB::where(function ($query) use ($request) {
            $query->whereBetween('startDate', [$request->startDate, $request->endDate])
                ->orWhereBetween('endDate', [$request->startDate, $request->endDate]);
        })->exists();

        if ($overlappingPeriods) {
            return redirect()->back()
                ->with('error', 'Periode PPDB tumpang tindih dengan periode yang sudah ada.');
        }

        PeriodePPDB::create($request->all());

        return redirect()->route('periode-ppdb.index')
            ->with('success', 'Periode PPDB berhasil dibuat.');
    }

    public function update(Request $request, PeriodePPDB $periode_ppdb)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        $periode_ppdb->update($request->only(['startDate', 'endDate', 'name']));

        return redirect()->route('periode-ppdb.index')
            ->with('success', 'Periode PPDB berhasil diupdate.');
    }

    public function destroy(PeriodePPDB $periode_ppdb)
    {
        $periode_ppdb->delete();

        return redirect()->route('periode-ppdb.index')
            ->with('success', 'Periode PPDB berhasil dihapus.');
    }

    public function show($id_periode)
    {
        $periode = PeriodePPDB::with(['bendahara', 'panitia'])->findOrFail($id_periode);

        return view('periode-ppdb.panitia', compact('periode'));
    }

    public function exportExcel($id_periode)
    {
        $periode = PeriodePPDB::findOrFail($id_periode);

        $safeName = preg_replace('/[^A-Za-z0-9_-]/', '_', $periode->name);

$fileName = "PPDB_{$safeName}_" . date('Y-m-d') . ".xlsx";

        return Excel::download(new PendaftarPpdbExport($periode), $fileName);
    }
}