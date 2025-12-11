<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TenagaPendidik;
use App\Models\BendaharaPpdb;
use App\Models\PanitiaPpdb;

class PanitiaBendaharaPeriodePPDBController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'periode_id' => 'required|exists:periode_ppdb,id_periode',
            'jabatan' => 'required|in:Panitia,Bendahara',
        ]);

        // ✅ CEK: Apakah user adalah guru?
        $user = User::find($request->user_id);
        if ($user->role !== 'guru') {
            return redirect()
                ->back()
                ->with('error', 'Hanya guru yang bisa ditugaskan sebagai Panitia atau Bendahara!');
        }

        // ✅ CEK: Apakah user sudah jadi panitia di periode ini?
        $sudahPanitia = PanitiaPpdb::where('user_id', $request->user_id)
            ->where('id_periode', $request->periode_id)
            ->exists();

        // ✅ CEK: Apakah user sudah jadi bendahara di periode ini?
        $sudahBendahara = BendaharaPpdb::where('user_id', $request->user_id)
            ->where('id_periode', $request->periode_id)
            ->exists();

        // ✅ VALIDASI: Tidak boleh rangkap jabatan
        if ($sudahPanitia || $sudahBendahara) {
            return redirect()
                ->back()
                ->with('error', 'Guru ini sudah ditugaskan sebagai Panitia atau Bendahara di periode ini!');
        }

        if ($request->jabatan == 'Panitia') {
            PanitiaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
            
            // ❌ JANGAN UPDATE ROLE DI USERS
            // User::where('id', $request->user_id)->update(['role' => 'panitia']);
            
            TenagaPendidik::where('id', $request->user_id)->update(['jabatan' => 'Panitia']);
        }

        if ($request->jabatan == 'Bendahara') {
            BendaharaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
            
            // ❌ JANGAN UPDATE ROLE DI USERS
            // User::where('id', $request->user_id)->update(['role' => 'bendahara']);
            
            TenagaPendidik::where('id', $request->user_id)->update(['jabatan' => 'Bendahara']);
        }

        return redirect()->route('periode-ppdb.show', $request->periode_id)
            ->with('success', 'Panitia/Bendahara berhasil ditambahkan!');
    }
}