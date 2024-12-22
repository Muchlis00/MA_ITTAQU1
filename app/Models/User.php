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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function periodePpdb()
    {
        return $this->belongsToMany(PeriodePpdb::class, 'panitia_ppdb', 'user_id', 'id_periode');
    }
    // Set role
    //     public function isKepsek()
    //     {
    //         return $this->role === 'kepsek';
    //     }

    //     public function isPanitia()
    //     {
    //         return $this->role === 'panitia';
    //     }

    //     public function isBendahara()
    //     {
    //         return $this->role === 'bendahara';
    //     }

    //     public function isPendaftar()
    //     {
    //         return $this->role === 'pendaftar';
    //     }
}
