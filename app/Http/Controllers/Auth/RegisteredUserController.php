<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendaftarPpdb;
use App\Models\PeriodePPDB;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ✅ Gunakan Database Transaction untuk memastikan data konsisten
        DB::beginTransaction();
        
        try {
            // ✅ 1. Buat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pendaftar',
            ]);

            // ✅ 2. Cari periode yang sedang aktif
            $periodeAktif = PeriodePPDB::where('startDate', '<=', Carbon::now())
                ->where('endDate', '>=', Carbon::now())
                ->first();

            // ✅ 3. Jika ada periode aktif, buat record di pendaftar_ppdb
            if ($periodeAktif) {
                PendaftarPpdb::create([
                    'user_id' => $user->id,
                    'id_periode' => $periodeAktif->id_periode,
                    'ready_to_verify' => 0,
                    'verification_status' => 'pending',
                ]);
            }

            // ✅ Commit transaction jika semua berhasil
            DB::commit();

            event(new Registered($user));
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);

        } catch (\Exception $e) {
            // ✅ Rollback jika ada error
            DB::rollBack();
            
            // Log error untuk debugging
            \Log::error('Registration failed: ' . $e->getMessage());
            
            // Redirect kembali dengan error message
            return back()
                ->withInput($request->only('name', 'email'))
                ->withErrors(['error' => 'Registrasi gagal. Silakan coba lagi.']);
        }
    }
}