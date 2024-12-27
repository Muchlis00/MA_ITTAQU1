<?php

namespace App\Http\Controllers;

use App\Models\PendaftarPpdb;
use App\Models\WaliPendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormPendaftarController extends Controller
{

    public function index()
    {
        return view('form-pendaftar.index');
    }
    /**
     * Show the student registration form
     */
    public function dataPendaftar()
    {
        // Check if user already has registration data
        $pendaftar = PendaftarPpdb::where('user_id', Auth::id())->first();
        
        if ($pendaftar) {
            return redirect()->route('form-pendaftar.data-orang-tua');
        }
        
        return view('form-pendaftar.data-pendaftar');
    }

    /**
     * Store student registration data
     */
    public function storeDataPendaftar(Request $request)
    {
        $validated = $request->validate([
            'nama_pendaftar' => 'required|string|max:255',
            'ttl_pendaftar' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:pendaftar_ppdb,nisn',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara' => 'required|integer|min:0',
            'sekolah_asal' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string',
            'telepon_pendaftar' => 'required|string|max:15'
        ]);

        // Create new pendaftar record
        PendaftarPpdb::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $validated['nama_pendaftar'],
            'ttl' => $validated['ttl_pendaftar'],
            'nisn' => $validated['nisn'],
            'anak_ke' => $validated['anak_ke'],
            'jumlah_saudara' => $validated['jumlah_saudara'],
            'sekolah_asal' => $validated['sekolah_asal'],
            'alamat_sekolah' => $validated['alamat_sekolah'],
            'telepon' => $validated['telepon_pendaftar']
        ]);

        return redirect()->route('form-pendaftar.data-orang-tua')
            ->with('success', 'Data pendaftar berhasil disimpan');
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