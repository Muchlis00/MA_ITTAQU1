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
        if ($request->jabatan == 'Panitia') {
            PanitiaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
            User::where('id', $request->user_id)->update(['role' => 'panitia']);
            TenagaPendidik::where('id', $request->user_id)->update(['jabatan' => 'Panitia']);
        }
        if ($request->jabatan == 'Bendahara') {
            BendaharaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
            User::where('id', $request->user_id)->update(['role' => 'bendahara']);
            TenagaPendidik::where('id', $request->user_id)->update(['jabatan' => 'Bendahara']);
        }

        return redirect()->route('periode-ppdb.show', $request->periode_id)
            ->with('success', 'Panitia dan Bendahara berhasil ditambahkan.');
    }
    
}
