<?php

namespace App\Http\Controllers;

use App\Models\PendaftarPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $role = Auth::user()->role;
        if($role == 'pendaftar'){
            return redirect()->route('formulir-ppdb.dataPendaftar');
        }
        if (view()->exists("dashboard.{$role}")){
            $pendaftar = PendaftarPpdb::with('user', 'periode')->get();
            return view("dashboard.{$role}", compact('pendaftar'));
        }
        return view('dashboard');
    }
}
