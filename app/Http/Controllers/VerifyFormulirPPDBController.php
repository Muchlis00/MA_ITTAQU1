<?php

namespace App\Http\Controllers;

use App\Mail\PaymentRejectionMail;
use App\Models\BendaharaPpdb;
use App\Models\PeriodePPDB;
use App\Models\PembayaranPpdb;
use App\Models\PendaftarPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyFormulirPPDBController extends Controller
{
    public function index(Request $request)
    {
        $listUserIdPendaftar = PendaftarPpdb::where('ready_to_verify', true)->get('user_id');
        $listBuktiBayar = PembayaranPpdb::where(['user_id' => $listUserIdPendaftar->toArray(), 'verification_status' => 'pending'])->with('user')->get();

        return view('verify-payment.index', compact('listUserIdPendaftar', 'listBuktiBayar'));
    }
    public function verify(Request $request){

    }
}