<?php

namespace App\Http\Controllers;

use App\Models\BendaharaPpdb;
use Illuminate\Http\Request;

class BendaharaPPDBController extends Controller
{
    public function destroy($id, Request $request)
    {
        try {
            $bendahara = BendaharaPpdb::findOrFail($id);
            $bendahara->delete();
            
            return redirect()
                ->route('periode-ppdb.show', $request->id_periode)
                ->with('success', 'Bendahara berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus bendahara');
        }
    }
}