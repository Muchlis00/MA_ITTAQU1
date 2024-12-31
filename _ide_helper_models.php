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
 * @property int $created_by
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgreementPpdb whereUpdatedAt($value)
 */
	class AgreementPpdb extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BendaharaPpdb whereUserId($value)
 */
	class BendaharaPpdb extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $gender
 * @property string $place_of_birth
 * @property string $date_of_birth
 * @property string $nisn
 * @property string $phone
 * @property string $child_number
 * @property string $sibling
 * @property string $previous_school_name
 * @property string $previous_school_address
 * @property string|null $ijazah
 * @property string|null $photo
 * @property string|null $akte_kelahiran
 * @property string|null $kip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WaliPendaftar> $wali
 * @property-read int|null $wali_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereAkteKelahiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereChildNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereIjazah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereKip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereNisn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar wherePreviousSchoolAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar wherePreviousSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereSibling($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataDiriPendaftar whereUserId($value)
 */
	class DataDiriPendaftar extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $id_periode
 * @property int $created_by
 * @property string $detail_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran whereDetailPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformasiPembayaran whereUpdatedAt($value)
 */
	class InformasiPembayaran extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $datetime
 * @property string $kegiatan
 * @property string $keterangan
 * @property int $created_by
 * @property int $id_periode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\PeriodePPDB $periode
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orientasi whereUpdatedAt($value)
 */
	class Orientasi extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PanitiaPpdb whereUserId($value)
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
 * @property int|null $verifier_id
 * @property string $verification_status
 * @property string|null $bukti_pembayaran
 * @property string $status_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $verifier
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereStatusPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereVerificationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PembayaranPpdb whereVerifierId($value)
 */
	class PembayaranPpdb extends \Eloquent {}
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
 * @property int $ready_to_verify
 * @property string $verification_status
 * @property int|null $verifier_id
 * @property-read \App\Models\DataDiriPendaftar|null $dataDiriPendaftar
 * @property-read \App\Models\PeriodePPDB $periode
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereReadyToVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereVerificationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendaftarPpdb whereVerifierId($value)
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InformasiPembayaran> $detail_pembayaran
 * @property-read int|null $detail_pembayaran_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orientasi> $orientasi
 * @property-read int|null $orientasi_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $panitia
 * @property-read int|null $panitia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PembayaranPpdb> $pembayaran
 * @property-read int|null $pembayaran_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PendaftarPpdb> $pendaftar
 * @property-read int|null $pendaftar_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB whereIdPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeriodePPDB whereUpdatedAt($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereIdPendidik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereJkGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereNamaGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereTempatGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereTglGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenagaPendidik whereUpdatedAt($value)
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
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PeriodePPDB> $periodePpdb
 * @property-read int|null $periode_ppdb_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $data_diri_pendaftar_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $place_of_birth
 * @property string $date_of_birth
 * @property string $gender
 * @property string $pekerjaan
 * @property string $pendapatan
 * @property string|null $ktp
 * @property string|null $kartu_keluarga
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DataDiriPendaftar $pendaftar
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereDataDiriPendaftarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereKartuKeluarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereKtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar wherePekerjaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar wherePendapatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WaliPendaftar whereUpdatedAt($value)
 */
	class WaliPendaftar extends \Eloquent {}
}

