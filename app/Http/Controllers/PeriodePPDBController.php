<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodePPDB;
use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use App\Models\User;

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

    public function exportPdf($id_periode)
    {
        $periode = PeriodePPDB::findOrFail($id_periode);

        $pendaftar = PendaftarPpdb::with('dataDiriPendaftar')
            ->where('id_periode', $id_periode)
            ->get();
        $domisiliTerbanyak = $pendaftar
    ->pluck('dataDiriPendaftar.domisili')
    ->filter()
    ->countBy()
    ->sortDesc()
    ->take(1);    

    $sekolahTerbanyak = $pendaftar
    ->pluck('dataDiriPendaftar.previous_school_name')
    ->filter()
    ->countBy()
    ->sortDesc()
    ->take(1);

        $pembayaran = PembayaranPpdb::where('id_periode', $id_periode)->get();

        $statusCount = [
            'menunggu_verifikasi' => 0,
            'selesai' => 0,
            'perlu_perbaikan' => 0,
            'belum_mengisi' => 0
        ];

        foreach ($pendaftar as $item) {

            $payment = $pembayaran->firstWhere('user_id', $item->user_id);

            $formStatus = $item->verification_status ?? null;
            $paymentStatus = $payment->verification_status ?? null;

            $status = $this->getDashboardStatus($formStatus, $paymentStatus);

            $statusCount[$status]++;
        }

        $totalPendaftar = $pendaftar->count();
        $totalPend = $statusCount['menunggu_verifikasi'];
        $totalRejec = $statusCount['perlu_perbaikan'];
        $totalaccount = $statusCount['belum_mengisi'];
        $totalSelesai = $statusCount['selesai'];

        // Gender
        $genL = $pendaftar->filter(function ($p) {
            return optional($p->dataDiriPendaftar)->gender == 'Laki-Laki';
        })->count();

        $genP = $pendaftar->filter(function ($p) {
            return optional($p->dataDiriPendaftar)->gender == 'Perempuan';
        })->count();

        // KIP
        $kip = $pendaftar->filter(function ($p) {
            return optional($p->dataDiriPendaftar)->kip &&
                   optional($p->dataDiriPendaftar)->kip != '-';
        })->count();

        $nokip = $pendaftar->filter(function ($p) {
            return optional($p->dataDiriPendaftar)->kip == '-';
        })->count();

        $kepsek = User::where('role','kepsek')->first();

        return view('periode-ppdb.exportPdf', compact(
    'kepsek',
    'periode',
    'totalPendaftar',
    'totalPend',
    'totalRejec',
    'totalaccount',
    'totalSelesai',
    'kip',
    'nokip',
    'genL',
    'genP',
    'domisiliTerbanyak',
    'sekolahTerbanyak'
));
    }

    private function getDashboardStatus($formStatus, $paymentStatus)
    {
        if (is_null($formStatus) && is_null($paymentStatus)) {
            return 'belum_mengisi';
        }

        if ($formStatus === 'verified' && $paymentStatus === 'verified') {
            return 'selesai';
        }

        if ($formStatus === 'rejected' || $paymentStatus === 'rejected') {
            return 'perlu_perbaikan';
        }

        if (
            ($formStatus === 'pending' && $paymentStatus === 'pending') ||
            ($formStatus === 'verified' && $paymentStatus === 'pending')
        ) {
            return 'menunggu_verifikasi';
        }

        return 'belum_mengisi';
    }
}