<?php



namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Models\PeriodePPDB;
use App\Models\DataDiriPendaftar;
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
        $periode = PeriodePpdb::with(['bendahara', 'panitia'])->find($id_periode);

        return view('periode-ppdb.panitia', compact('periode'));
    }

   public function exportPdf($id_periode)
{
    
    $totalPendaftar = $this->TotalRegisPeriod($id_periode);
    $totalRejec = $this->TotalRejecPeriod($id_periode);
    $totalPend = $this->TotalPendPeriod($id_periode);
    $periode = PeriodePpdb::findorFail($id_periode);
    $totalaccount = $this->UserWithoutRegis($id_periode);
    $kip = $this->UserWithKip($id_periode);
    $nokip = $this->UserWithoutKip($id_periode);
    $kepsek = User::where('role','kepsek')->first();
    $genL = $this->UserMan($id_periode);
    $genP = $this->UserWoman($id_periode);
    return view('periode-ppdb.exportPdf', compact('kepsek','periode','totalPendaftar','totalRejec','totalPend','totalaccount','kip','nokip','genL','genP'));
    
}

private function TotalRegisPeriod($id_periode){
$periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
                  ->where('verification_status', 'verified') 
                  ->count();
}
private function TotalRejecPeriod($id_periode){
$periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
                  ->where('verification_status', 'Rejected') 
                  ->count();
}
private function TotalPendPeriod($id_periode){
$periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
                  ->where('verification_status', 'Pending') 
                  ->count();
}
private function UserWithoutRegis($id_periode){
 $users = User::where('role', 'pendaftar')
                ->whereDoesntHave('pendaftarPpdb', function ($query) use ($id_periode) {
                    $query->where('id_periode', $id_periode); 
                })
                ->count();
    return $users;
}
private function UserWithKip($id_periode){
 $periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
        ->whereHas('dataDiriPendaftar', function ($query) {
            $query->whereNotNull('kip');
        })
        ->count();  
}
private function UserWithoutKip($id_periode){
 $periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
        ->whereHas('dataDiriPendaftar', function ($query) {
            $query->whereNull('kip');
        })
        ->count();
}
private function UserMan($id_periode){
 $periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
        ->whereHas('dataDiriPendaftar', function ($query) {
            $query->where('gender','Laki-Laki');
        })
        ->count();  
}
private function UserWoman($id_periode){
 $periode = PeriodePPDB::findOrFail($id_periode);
    return $periode->pendaftar()
        ->whereHas('dataDiriPendaftar', function ($query) {
            $query->where('gender','Perempuan');
        })
        ->count();
}

}
