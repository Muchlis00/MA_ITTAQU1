<?php



namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Models\PeriodePPDB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\BendaharaPpdb;
use App\Models\PanitiaPpdb;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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
            $panitiaPpdb = PanitiaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
        }
        if ($request->jabatan == 'Bendahara') {
            $bendaharaPpdb = BendaharaPpdb::create([
                'id_periode' => $request->periode_id,
                'user_id' => $request->user_id,
            ]);
        }

        return redirect()->route('periode-ppdb.show', $request->periode_id)
            ->with('success', 'Panitia dan Bendahara berhasil ditambahkan.');
    }
    
}
