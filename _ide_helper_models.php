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

