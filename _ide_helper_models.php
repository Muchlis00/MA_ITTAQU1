<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $id_periode
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BendaharaPpdb whereUserId($value)
 */
	class BendaharaPpdb extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WaliPendaftar> $wali
 * @property-read int|null $wali_count
 * @method static \Illuminate\Database\Eloquent\Builder|DataDiriPendaftar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataDiriPendaftar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataDiriPendaftar query()
 */
	class DataDiriPendaftar extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $id_periode
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanitiaPpdb whereUserId($value)
 */
	class PanitiaPpdb extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $id_periode
 * @property int $user_id
 * @property string $bukti_pembayaran
 * @property string $status_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $verifier
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereStatusPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranPpdb whereUserId($value)
 */
	class PembayaranPpdb extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\PeriodePPDB|null $periode
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|PendaftarPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PendaftarPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PendaftarPpdb query()
 */
	class PendaftarPpdb extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_periode
 * @property string $name
 * @property string $startDate
 * @property string $endDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $bendahara
 * @property-read int|null $bendahara_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $panitia
 * @property-read int|null $panitia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PembayaranPpdb> $pembayaran
 * @property-read int|null $pembayaran_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PendaftarPpdb> $pendaftar
 * @property-read int|null $pendaftar_count
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB query()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodePPDB whereUpdatedAt($value)
 */
	class PeriodePPDB extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_pendidik
 * @property int|null $id
 * @property string $nip
 * @property string $nama_guru
 * @property string $tempat_guru
 * @property string $tgl_guru
 * @property string $jk_guru
 * @property string $jabatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik query()
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereIdPendidik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereJkGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereNamaGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereTempatGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereTglGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenagaPendidik whereUpdatedAt($value)
 */
	class TenagaPendidik extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PeriodePPDB> $periodePpdb
 * @property-read int|null $periode_ppdb_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\DataDiriPendaftar|null $pendaftar
 * @method static \Illuminate\Database\Eloquent\Builder|WaliPendaftar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaliPendaftar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaliPendaftar query()
 */
	class WaliPendaftar extends \Eloquent {}
}

