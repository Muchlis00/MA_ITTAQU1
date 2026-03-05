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

        $user = User::find($request->user_id);
        if ($user->role !== 'guru') {
            return redirect()
                ->back()
                ->with('error', 'Hanya guru yang bisa ditugaskan sebagai Panitia atau Bendahara!');
        }

        $sudahPanitia = PanitiaPpdb::where('user_id', $request->user_id)
            ->where('id_periode', $request->periode_id)
            ->exists();

        $sudahBendahara = BendaharaPpdb::where('user_id', $request->user_id)
            ->where('id_periode', $request->periode_id)
            ->exists();

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
            
            
            TenagaPendidik::where('id', $request->user_id)->update(['jabatan' => 'Panitia']);
        }

        if ($request->jabatan == 'Bendahara') {
            BendaharaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
            
            
            TenagaPendidik::where('id', $request->user_id)->update(['jabatan' => 'Bendahara']);
        }

        return redirect()->route('periode-ppdb.show', $request->periode_id)
            ->with('success', 'Panitia/Bendahara berhasil ditambahkan!');
    }
}