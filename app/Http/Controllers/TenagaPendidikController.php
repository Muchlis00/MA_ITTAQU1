<?php



namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Models\TenagaPendidik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {

            $tenagaPendidik = TenagaPendidik::all(); //->paginate(10) untuk tampil 10
            return view('tenaga-pendidik.index', compact('tenagaPendidik'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('/tenaga_pendidik/create');
        return view('tenaga-pendidik.create');
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
            'email' => 'required|email',
        ]);
        $user = User::create([
            'name' => $request->nama_guru,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => $request->jabatan,
        ]);
        $userId = $user->id;
        TenagaPendidik::create([
            'id' => $userId, 
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'tempat_guru' => $request->tempat_guru,
            'tgl_guru' => $request->tgl_guru,
            'jk_guru' => $request->jk_guru,
            'jabatan' => $request->jabatan,
        ]);
        event(new Registered($user));


        return redirect()->route('tenaga-pendidik.create')
            ->with('success', 'Data tenaga pendidik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenagaPendidik $tenagaPendidik)
    {

        return view('tenaga-pendidik.show', compact('tenagaPendidik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenagaPendidik $tenagaPendidik)
    {
        return view('tenaga-pendidik.edit', compact('tenagaPendidik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenagaPendidik $tenagaPendidik)
    {
        $request->validate([
            'nip' => 'required|unique:tenaga_pendidik,nip,' . $tenagaPendidik->id_pendidik,
            'nama_guru' => 'required|string|max:255',
            'tempat_guru' => 'required|string|max:255',
            'tgl_guru' => 'required|date',
            'jk_guru' => 'required',
            'jabatan' => 'required|string|max:255',
        ]);
        $tenagaPendidik->update($request->all()); // Memperbarui data
        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Data tenaga pendidik berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_pendidik)
    {
        $steam = TenagaPendidik::find($id_pendidik);
        $steam->delete();
        
        return redirect('tenaga-pendidik')->with('success', 'Data Tenaga Pendidik berhasil diHapus!');
        // return redirect('tenagapendidik/index')->with('success', 'tenaga pendidik berhasil dihapus!');
    }
}
