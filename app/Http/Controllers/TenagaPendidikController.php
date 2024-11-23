<?php



namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\tenaga_pendidik;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $tenagaPendidik = tenaga_pendidik::all();
            return view('tenaga_pendidik.index2', compact('tenagaPendidik'));
        }


        // $tenaga_pendidik = DB::table('tenaga_pendidik')->get();
        // return view('tenaga_pendidik.index2',['tenaga_pendidik' => $tenaga_pendidik]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenaga_pendidik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:tenaga_pendidik,nip',
            'nama_guru' => 'required|string|max:255',
            'tempat_guru' => 'required|string|max:255',
            'tgl_guru' => 'required|date',
            'jk_guru' => 'required',
            'jabatan' => 'required|string|max:255',
        ]);
        TenagaPendidik::create($request->all()); // Menyimpan data
        return redirect()->route('tenaga_pendidik.index')->with('success', 'Data Tenaga Pendidik berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(tenaga_pendidik $tenaga_pendidik)
    {
        return view('tenaga_pendidik.show', compact('tenaga_pendidik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tenaga_pendidik $tenaga_pendidik)
    {
        return view('tenaga_pendidik.edit', compact('tenaga_pendidik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tenaga_pendidik $tenaga_pendidik)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip,' . $tenaga_pendidik->id_pendidik,
            'nama_guru' => 'required|string|max:255',
            'tempat_guru' => 'required|string|max:255',
            'tgl_guru' => 'required|date',
            'jk_guru' => 'required',
            'jabatan' => 'required|string|max:255',
        ]);
        $tenaga_pendidik->update($request->all()); // Memperbarui data
        return redirect()->route('tenaga_pendidik.index')->with('success', 'tenaga_pendidik berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tenaga_pendidik $tenaga_pendidik)
    {
        $tenaga_pendidik->delete();
        return redirect()->route('tenaga_pendidik.index')->with('success', 'tenaga pendidik berhasil dihapus!');
    }
}
