<?php

namespace App\Http\Controllers;

use App\Models\DataDiriPendaftar;
use App\Models\PendaftarPpdb;
use App\Models\User;
use App\Models\WaliPendaftar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PeriodePPDB;
use Dflydev\DotAccessData\Data;

class FormPendaftarController extends Controller
{

    public function dataPendaftar()
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first();

        return view('form-pendaftar.data-pendaftar', compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar'));
    }

    /**
     * Store student registration data
     */
    public function storeDataPendaftar(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'periode_id' => 'required|exists:periode_ppdb,id_periode',
                'name' => 'required|string|max:255',
                'gender' => 'required|string|in:Laki-Laki,Perempuan',
                'place_of_birth' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'nisn' => 'required|string|max:20|unique:data_diri_pendaftar,nisn,' . $request->user_id . ',user_id',
                'phone' => 'required|string|max:15',
                'child_number' => 'required|integer|min:1',
                'sibling' => 'required|integer|min:0',
                'previous_school_name' => 'required|string|max:255',
                'previous_school_address' => 'required|string',
            ]);

            // Update or create DataDiriPendaftar
            DataDiriPendaftar::updateOrCreate(
                ['user_id' => $request->user_id], // Condition
                $request->except(['periode_id', 'name', '_token']) // Data to update or create
            );

            // Update the user's name
            User::find($request->user_id)->update(['name' => $request->name]);

            // Update or create PendaftarPpdb
            PendaftarPpdb::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'id_periode' => $request->periode_id,
                ]
            );

            return redirect()->route('formulir-ppdb.dataPendaftar')
                ->with('success', 'Data pendaftar berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Form submission error: ' . $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Show the parent registration form
     */
    public function dataOrangTua()
    {
        // Check if student data exists
        $pendaftar = PendaftarPpdb::where('user_id', Auth::id())->first();

        if (!$pendaftar) {
            return redirect()->route('form-pendaftar.data-pendaftar')
                ->with('error', 'Silahkan lengkapi data pendaftar terlebih dahulu');
        }

        // Check if parent data already exists
        $wali = WaliPendaftar::where('pendaftar_id', $pendaftar->id)->first();
        if ($wali) {
            // If parent data exists, redirect to dashboard or show readonly view
            return redirect()->route('dashboard')
                ->with('info', 'Formulir pendaftaran telah selesai diisi');
        }

        return view('form-pendaftar.data-orang-tua');
    }

    /**
     * Store parent registration data
     */
    public function storeDataOrangTua(Request $request)
    {
        $pendaftar = PendaftarPpdb::where('user_id', Auth::id())->first();

        if (!$pendaftar) {
            return redirect()->route('form-pendaftar.data-pendaftar')
                ->with('error', 'Silahkan lengkapi data pendaftar terlebih dahulu');
        }

        $validated = $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'ttl_ayah' => 'required|string|max:255',
            'ttl_ibu' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'pendapatan_ayah' => 'required|numeric|min:0',
            'pendapatan_ibu' => 'required|numeric|min:0',
            'alamat' => 'required|string',
            'telepon_ortu' => 'required|string|max:15'
        ]);

        // Create new wali record
        WaliPendaftar::create([
            'pendaftar_id' => $pendaftar->id,
            'nama_ayah' => $validated['nama_ayah'],
            'nama_ibu' => $validated['nama_ibu'],
            'ttl_ayah' => $validated['ttl_ayah'],
            'ttl_ibu' => $validated['ttl_ibu'],
            'pekerjaan_ayah' => $validated['pekerjaan_ayah'],
            'pekerjaan_ibu' => $validated['pekerjaan_ibu'],
            'pendapatan_ayah' => $validated['pendapatan_ayah'],
            'pendapatan_ibu' => $validated['pendapatan_ibu'],
            'alamat' => $validated['alamat'],
            'telepon' => $validated['telepon_ortu']
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil diselesaikan');
    }
}
