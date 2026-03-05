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

    public function getEffectiveRole()
    {
        if ($this->role !== 'guru') {
            return $this->role;
        }

        if ($this->isPanitiaAktif()) {
            return 'panitia';
        }

        if ($this->isBendaharaAktif()) {
            return 'bendahara';
        }

        return $this->role;
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        }

        if (in_array($this->role, $roles)) {
            return true;
        }

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