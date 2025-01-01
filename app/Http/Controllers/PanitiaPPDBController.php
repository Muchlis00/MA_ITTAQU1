<?php

namespace App\Http\Controllers;

use App\Models\PanitiaPpdb;
use Illuminate\Http\Request;

class PanitiaPPDBController extends Controller
{
    public function destroy($id, Request $request)
    {
        try {
            $panitia = PanitiaPpdb::findOrFail($id);
            $panitia->delete();
            
            return redirect()
                ->route('periode-ppdb.show', $request->id_periode)
                ->with('success', 'Panitia berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus panitia');
        }
    }
}