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

        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pendaftar',
            ]);

            $periodeAktif = PeriodePPDB::where('startDate', '<=', Carbon::now())
                ->where('endDate', '>=', Carbon::now())
                ->first();

            if ($periodeAktif) {
                PendaftarPpdb::create([
                    'user_id' => $user->id,
                    'id_periode' => $periodeAktif->id_periode,
                    'ready_to_verify' => 0,
                    'verification_status' => null,
                ]);
            }

            DB::commit();

            event(new Registered($user));
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Registration failed: ' . $e->getMessage());
            
            return back()
                ->withInput($request->only('name', 'email'))
                ->withErrors(['error' => 'Registrasi gagal. Silakan coba lagi.']);
        }
    }
}