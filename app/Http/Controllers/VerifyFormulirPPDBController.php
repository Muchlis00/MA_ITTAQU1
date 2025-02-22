<?php

namespace App\Http\Controllers;

use App\Mail\FormulirVerifiedMail;
use App\Mail\FormulirRejectionMail;
use App\Models\DataDiriPendaftar;
use App\Models\PendaftarPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyFormulirPPDBController extends Controller
{
    public function index(Request $request)
    {
        $listUserIdPendaftar = PendaftarPpdb::where(['ready_to_verify' => true, 'verification_status' => 'pending'])->get('user_id');
        $listPendaftar = DataDiriPendaftar::where('user_id',$listUserIdPendaftar->toArray())->with(['user', 'wali'])->get();
        return view('verify-formulir.index', compact('listPendaftar'));
    }
    public function verify( $id,Request $request){
        $userPendaftar = PendaftarPpdb::find($id)->with('user')->first();
        PendaftarPpdb::where('id', $id)->update(['verifier_id' => Auth::id(), 'verification_status' => 'verified', 'ready_to_verify' => false]);
        Mail::to($userPendaftar->user->email)->send(new FormulirVerifiedMail(
            $userPendaftar->user
        ));
        return redirect()->back()->with('success', 'Formulir berhasil diverifikasi');
    }

    public function reject($id,Request $request){
        $userPendaftar = PendaftarPpdb::find($id)->with('user')->first();
        PendaftarPpdb::where('id', $id)->update(['verifier_id' => Auth::id(), 'verification_status' => 'rejected']);
        Mail::to($userPendaftar->user->email)->send(new FormulirRejectionMail(
            $request->rejection_reason,
            $userPendaftar->user
        ));
        return redirect()->back()->with('success', 'Formulir berhasil diverifikasi');
    }
}