<?php



namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Models\PeriodePPDB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\BendaharaPpdb;
use App\Models\PanitiaPpdb;

class PeriodePPDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $periodePPDB = PeriodePPDB::all();
        $keys = ['id', 'nama', 'mulai', 'selesai', 'action'];
        return view('periode-ppdb.index', compact('periodePPDB', 'keys'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

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
        $periode = PeriodePpdb::with(['bendahara', 'panitia'])->find($id_periode);

        return view('periode-ppdb.panitia', compact('periode'));
    }
}
