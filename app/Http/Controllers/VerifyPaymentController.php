<?php

namespace App\Http\Controllers;

use App\Mail\PaymentRejectionMail;
use App\Mail\PaymentVerifiedMail;
use App\Models\BendaharaPpdb;
use App\Models\PeriodePPDB;
use App\Models\PembayaranPpdb;
use App\Models\PendaftarPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyPaymentController extends Controller
{
    public function index(Request $request)
    {
        $listUserIdPendaftar = PendaftarPpdb::where('ready_to_verify', true)->get('user_id');
        $listBuktiBayar = PembayaranPpdb::where(['user_id' => $listUserIdPendaftar->toArray(), 'verification_status' => 'pending'])->with('user')->get();

        return view('verify-payment.index', compact('listUserIdPendaftar', 'listBuktiBayar'));
    }
    public function verify($id,Request $request){
        $pendaftar = PembayaranPpdb::where('id', $id)->with('user')->first();
        PembayaranPpdb::where('id', $id)->update(['verifier_id' => Auth::id(), 'verification_status' => 'verified']);
        Mail::to($pendaftar->user->email)->send(new PaymentVerifiedMail(
            $pendaftar->user
        ));
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function reject($id,Request $request){
        $pendaftar = PembayaranPpdb::where('id', $id)->with('user')->first();
        PembayaranPpdb::where('id', $id)->update(['verifier_id' => Auth::id(), 'verification_status' => 'rejected']);
        // \Log::info($pendaftar);
        // PendaftarPpdb::where('user_id', $pendaftar->user_id)->update(['ready_to_verify' => false]);
        Mail::to($pendaftar->user->email)->send(new PaymentRejectionMail(
            $request->rejection_reason,
            $pendaftar->user
        ));
        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak dan email notifikasi telah dikirim');
    }
}