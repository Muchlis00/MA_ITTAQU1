<?php

namespace App\Http\Controllers;

use App\Models\DataDiriPendaftar;
use App\Models\InformasiPembayaran;
use App\Models\PembayaranPpdb;
use App\Models\PendaftarPpdb;
use App\Models\User;
use App\Models\WaliPendaftar;
use App\Models\AgreementPpdb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PeriodePPDB;
use stdClass;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FormPendaftarController extends Controller
{
    private function generatePathName($name)
    {
        $name = str_replace(' ', '_', $name);
        $name = strtolower($name);
        $name = $name . '_' . Carbon::now()->timestamp;
        return $name;
    }
    private function storeFile($request, $name)
    {
        return $request->file($name)->store($this->generatePathName($request[$name]->getClientOriginalName()), 'public');
    }

    public function dataPendaftar()
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first() ?? new DataDiriPendaftar();
        $currentAgreement = AgreementPpdb::where('id_periode', $currentPeriode->id_periode)->first();
        $cities = $this->getCities();
        return view('form-pendaftar.data-pendaftar', compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar', 'currentAgreement', 'cities'));
    }

    public function storeDataPendaftar(Request $request)
    {
        try {
            Log::info('Data Pendaftar:', $request->all());
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'periode_id' => 'required|exists:periode_ppdb,id_periode',
                'name' => 'required|string|max:255',
                'gender' => 'required|string|in:Laki-Laki,Perempuan',
                'place_of_birth' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'nisn' => 'required|string|max:20|unique:data_diri_pendaftar,nisn,' . $request->user_id . ',user_id',
                'phone' => 'required|string|max:15',
                'domisili' => 'required|string|max:255',
                'child_number' => 'required|integer|min:1',
                'sibling' => 'required|integer|min:0',
                'previous_school_name' => 'required|string|max:255',
                'previous_school_address' => 'required|string',
            ]);

            $dataToSave = $request->except(['periode_id', 'name', '_token']);

            DataDiriPendaftar::updateOrCreate(
                ['user_id' => $request->user_id], 
                $dataToSave
            );

            User::find($request->user_id)->update(['name' => $request->name]);

            PendaftarPpdb::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'id_periode' => $request->periode_id,
                ]
            );

            return redirect()->back()->with('success', 'Data pendaftar berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Form submission error: ' . $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function nilaiRapor(Request $request)
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first();

        if (!$currentDataDiriPendaftar) {
            return redirect()
                ->route('formulir-ppdb.dataPendaftar')
                ->with('failed', 'Silakan isi Data Pendaftar terlebih dahulu');
        }

        return view('form-pendaftar.nilai-rapor', compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar'));
    }

    public function storeNilaiRapor(Request $request)
    {
        $request->validate([
            'nilai_rapor' => 'required|array',
            'nilai_rapor.*.*' => 'required|numeric|min:0|max:100',
        ]);

        $dataDiri = DataDiriPendaftar::where('user_id', Auth::id())->first();

        if (!$dataDiri) {
            return redirect()
                ->route('formulir-ppdb.dataPendaftar')
                ->with('failed', 'Silakan isi Data Pendaftar terlebih dahulu');
        }

        $dataDiri->update([
            'nilai_rapor' => $request->input('nilai_rapor', []),
        ]);

        return redirect()
            ->route('formulir-ppdb.nilaiRapor')
            ->with('success', 'Nilai rapor berhasil disimpan');
    }

    public function dataOrangTua()
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->first();
        if (!$currentPeriode) {
        return redirect()->route('dashboard')
        ->with('error', 'Tidak ada periode pendaftaran yang sedang aktif saat ini');
}
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first() ?? new DataDiriPendaftar();
        $currentDataAyah = WaliPendaftar::where(['data_diri_pendaftar_id' => $currentDataDiriPendaftar->id, 'gender' => 'Laki-Laki'])->first() ?? new WaliPendaftar();
        $currentDataIbu = WaliPendaftar::where(['data_diri_pendaftar_id' => $currentDataDiriPendaftar->id, 'gender' => 'Perempuan'])->first() ?? new WaliPendaftar();
        $cities = $this->getCities();
        return view(
            'form-pendaftar.data-orang-tua',
            compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar', 'currentDataAyah', 'currentDataIbu', 'cities')
        );
    }

    public function storeDataOrangTua(Request $request)
    {
        $pendaftar = PendaftarPpdb::where('user_id', Auth::id())->first();

        if (!$pendaftar) {
            return redirect()->route('formulir-ppdb.dataPendaftar')
                ->with('error', 'Silahkan lengkapi data pendaftar terlebih dahulu');
        }

        $request->validate([
            'data_diri_pendaftar_id' => 'required|exists:data_diri_pendaftar,id',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_place_of_birth' => 'required|string|max:255',
            'mother_place_of_birth' => 'required|string|max:255',
            'father_date_of_birth' => 'required|date',
            'mother_date_of_birth' => 'required|date',
            'father_job' => 'required|string|max:255',
            'mother_job' => 'required|string|max:255',
            'father_income' => 'required|numeric|min:0',
            'mother_income' => 'required|numeric|min:0',
            'father_phone' => 'required|string|max:15',
            'mother_phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        WaliPendaftar::updateOrCreate(['data_diri_pendaftar_id' => $request->data_diri_pendaftar_id, 'gender' => 'Laki-Laki',], [
            'data_diri_pendaftar_id' => $request->data_diri_pendaftar_id,
            'name' => $request->father_name,
            'address' => $request->address,
            'phone' => $request->father_phone,
            'place_of_birth' => $request->father_place_of_birth,
            'date_of_birth' => $request->father_date_of_birth,
            'gender' => 'Laki-Laki',
            'pekerjaan' => $request->father_job,
            'pendapatan' => $request->father_income,
        ]);

        WaliPendaftar::updateOrCreate(['data_diri_pendaftar_id' => $request->data_diri_pendaftar_id, 'gender' => 'Perempuan',], [
            'data_diri_pendaftar_id' => $request->data_diri_pendaftar_id,
            'name' => $request->mother_name,
            'address' => $request->address,
            'phone' => $request->mother_phone,
            'place_of_birth' => $request->mother_place_of_birth,
            'date_of_birth' => $request->mother_date_of_birth,
            'gender' => 'Perempuan',
            'pekerjaan' => $request->mother_job,
            'pendapatan' => $request->mother_income,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil diselesaikan');
    }

    public function dokumenPendaftar(Request $request)
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first();

        return view('form-pendaftar.dokumen-pendaftar', compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar'));
    }
    public function storeDokumenPendaftar(Request $request)
    {
        $request->validate([
            'ijazah' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'akte_kelahiran' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'kip' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'rapor_semester_1' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'rapor_semester_2' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'rapor_semester_3' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'rapor_semester_4' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'rapor_semester_5' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'rapor_semester_6' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = [];

        $possibleFields = ['ijazah', 'photo', 'akte_kelahiran', 'kip', 'rapor_semester_1', 'rapor_semester_2', 'rapor_semester_3', 'rapor_semester_4', 'rapor_semester_5', 'rapor_semester_6'];

        foreach ($possibleFields as $field) {
            if ($request->hasFile($field)) {
                $updateData[$field] = $this->storeFile($request, $field);
            }
        }

        $dataDiri = DataDiriPendaftar::updateOrCreate(
            ['user_id' => Auth::id()],
            ['user_id' => Auth::id()]
        );

        if (!$request->hasFile('kip')) {
            if (is_null($dataDiri->kip)) {
                $updateData['kip'] = '-';
            }
        }

        if (!empty($updateData)) {
            $dataDiri->update($updateData);
        }

        return redirect()->route('formulir-ppdb.dokumenPendaftar')
            ->with('success', 'Dokumen berhasil disimpan');
    }

    public function dokumenOrangTua(Request $request)
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first();
        $currentWali = new stdClass();
        $currentWali->father = WaliPendaftar::where([
            'data_diri_pendaftar_id' => $currentDataDiriPendaftar->id,
            'gender' => 'Laki-Laki'
        ])->first() ?? new WaliPendaftar();

        $currentWali->mother = WaliPendaftar::where([
            'data_diri_pendaftar_id' => $currentDataDiriPendaftar->id,
            'gender' => 'Perempuan'
        ])->first() ?? new WaliPendaftar();

        return view('form-pendaftar.dokumen-orang-tua', compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar', 'currentWali'));
    }

    public function storeDokumenOrangTua(Request $request)
    {
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())
            ->firstOrFail();

        $fieldMappings = [
            'father' => [
                'gender' => 'Laki-Laki',
                'fields' => [
                    'father_ktp' => 'ktp',
                    'kartu_keluarga' => 'kartu_keluarga'
                ]
            ],
            'mother' => [
                'gender' => 'Perempuan',
                'fields' => [
                    'mother_ktp' => 'ktp'
                ]
            ]
        ];

        foreach ($fieldMappings as $parent => $mapping) {
            $updates = [];

            foreach ($mapping['fields'] as $requestField => $dbField) {
                if ($request->hasFile($requestField)) {
                    $updates[$dbField] = $this->storeFile($request, $requestField);
                }
            }

            if (!empty($updates)) {
                WaliPendaftar::where([
                    'data_diri_pendaftar_id' => $currentDataDiriPendaftar->id,
                    'gender' => $mapping['gender']
                ])->update($updates);
            }
        }

        return redirect()
            ->route('formulir-ppdb.dokumenOrangTua')
            ->with('success', 'Dokumen berhasil disimpan');
    }

    public function pembayaran(Request $request)
    {
        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();
        $currentUser = Auth::user();
        $currentDataDiriPendaftar = DataDiriPendaftar::where('user_id', Auth::id())->first();
        $currentPembayaran = PembayaranPpdb::where(['id_periode' => $currentPeriode->id_periode, 'verification_status' => ['pending', 'verified']])->where('user_id', Auth::id())->get();
        $informasiPembayaran = InformasiPembayaran::where('id_periode', $currentPeriode->id_periode)->first();
        return view('form-pendaftar.pembayaran', compact('currentPeriode', 'currentUser', 'currentDataDiriPendaftar', 'currentPembayaran', 'informasiPembayaran'));
    }

    public function storePembayaran(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $currentPeriode = PeriodePPDB::where('startDate', '<=', Carbon::now())
            ->where('endDate', '>=', Carbon::now())
            ->firstOrFail();

        $existingPembayaran = PembayaranPpdb::where('id_periode', $currentPeriode->id_periode)
            ->where('user_id', Auth::id())
            ->first();

        $dataToSave = [
            'id_periode' => $currentPeriode->id_periode,
            'user_id' => Auth::id(),
        ];

        if ($request->hasFile('bukti_pembayaran')) {
            $dataToSave['bukti_pembayaran'] = $this->storeFile($request, 'bukti_pembayaran');
        }

        if ($existingPembayaran) {
            if (isset($dataToSave['bukti_pembayaran'])) {
                $existingPembayaran->update($dataToSave);
            }
        } else {
            PembayaranPpdb::create($dataToSave);
        }

        return redirect()
            ->route('formulir-ppdb.pembayaran')
            ->with('success', 'Pembayaran berhasil disimpan');
    }

    public function kirimFormulir(Request $request)
    {
        PendaftarPpdb::where('user_id', Auth::id())->update([
            'ready_to_verify' => true,
            'verification_status' => 'pending'
        ]);
        PembayaranPpdb::where('user_id', Auth::id())->update([
            'verification_status' => 'pending',
            'status_pembayaran' => 'Belum Lunas'
        ]);
        return redirect()->route('formulir-ppdb.pembayaran')
            ->with('success', 'Formulir berhasil dikirim untuk verifikasi');
    }
    public function deleteKip(Request $request)
{
    \Log::info('deleteKip dipanggil oleh user: ' . Auth::id());

    $user = Auth::user();
    $dataDiri = DataDiriPendaftar::where('user_id', $user->id)->first();

    if (!$dataDiri) {
        \Log::error('DataDiri tidak ditemukan untuk user: ' . $user->id);
        return redirect()->back()->with('error', 'Data pendaftar tidak ditemukan.');
    }

    \Log::info('DataDiri sebelum dihapus:', ['kip' => $dataDiri->kip]);

    if ($dataDiri->kip && $dataDiri->kip !== '-') {
        $deleted = Storage::disk('public')->delete($dataDiri->kip);
        \Log::info('Hapus file: ' . ($deleted ? 'berhasil' : 'gagal'));
    }

    $updated = $dataDiri->update(['kip' => '-']);
    \Log::info('Update database: ' . ($updated ? 'berhasil' : 'gagal'));

    $dataDiriFresh = $dataDiri->fresh();
    \Log::info('DataDiri setelah update:', ['kip' => $dataDiriFresh->kip]);

    return redirect()->back()->with('success', 'File KIP berhasil dihapus.');
}
    private function getCities()
    {
        $json = Storage::get('cities.json');
        return json_decode($json, true);
    }
}
