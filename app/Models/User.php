<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function periodePpdb()
    {
        return $this->belongsToMany(PeriodePpdb::class, 'panitia_ppdb', 'user_id', 'id_periode');
    }

    public function panitiaPpdb()
    {
        return $this->hasMany(PanitiaPpdb::class, 'user_id');
    }

    public function bendaharaPpdb()
    {
        return $this->hasMany(BendaharaPpdb::class, 'user_id');
    }

    public function isPanitiaAktif()
    {
        return $this->panitiaPpdb()
            ->whereHas('periode', function($query) {
                $now = now();
                $query->whereDate('startDate', '<=', $now)
                      ->whereDate('endDate', '>=', $now);
            })
            ->exists();
    }

    public function isBendaharaAktif()
    {
        return $this->bendaharaPpdb()
            ->whereHas('periode', function($query) {
                $now = now();
                $query->whereDate('startDate', '<=', $now)
                      ->whereDate('endDate', '>=', $now);
            })
            ->exists();
    }

    // ✅ TAMBAHKAN METHOD INI:
    /**
     * Get effective role (role yang sedang aktif berdasarkan periode)
     * Priority: role tetap > role periode aktif
     */
    public function getEffectiveRole()
    {
        // Jika role bukan guru, return role asli
        if ($this->role !== 'guru') {
            return $this->role;
        }

        // Jika guru adalah panitia di periode aktif
        if ($this->isPanitiaAktif()) {
            return 'panitia';
        }

        // Jika guru adalah bendahara di periode aktif
        if ($this->isBendaharaAktif()) {
            return 'bendahara';
        }

        // Default return role asli
        return $this->role;
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        }

        // Cek role tetap
        if (in_array($this->role, $roles)) {
            return true;
        }

        // Cek role dinamis berdasarkan periode aktif
        foreach ($roles as $role) {
            if ($role === 'panitia' && $this->isPanitiaAktif()) {
                return true;
            }
            if ($role === 'bendahara' && $this->isBendaharaAktif()) {
                return true;
            }
        }

        return false;
    }

    public function pendaftarPpdb()
    {
        return $this->hasMany(PendaftarPpdb::class, 'user_id', 'id');
    }
}