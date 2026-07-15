<?php

namespace App\Exports;

use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use App\Models\InformasiPembayaran;
use App\Models\PeriodePPDB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftarPpdbExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $periode;
    protected $pembayaran;
    protected $infoPembayaran;
    protected $counter = 0;

    public function __construct(PeriodePPDB $periode)
    {
        $this->periode = $periode;
        $this->pembayaran = PembayaranPpdb::where('id_periode', $periode->id_periode)->get();
        $this->infoPembayaran = InformasiPembayaran::where('id_periode', $periode->id_periode)->first();
    }

    public function collection()
    {
        return PendaftarPpdb::with(['user', 'dataDiriPendaftar', 'dataDiriPendaftar.wali'])
            ->where('id_periode', $this->periode->id_periode)
            ->get();
    }

    public function headings(): array
    {
        return [
            // Data Periode
            'Nama Periode',
            'Tanggal Mulai',
            'Tanggal Selesai',

            // Data Pendaftar
            'No',
            'Nama Pendaftar',
            'Status Verifikasi Formulir',
            'Status Verifikasi Pembayaran',
            'Status Pembayaran',
            'Total Yang Dibayar',
            'Status Keseluruhan',

            // Data Diri
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'NISN',
            'No. HP',
            'Domisili',
            'Anak Ke',
            'Jumlah Saudara',
            'Asal Sekolah',
            'Alamat Asal Sekolah',
            'Memiliki KIP',

            // Data Ayah (Wali Laki-Laki)
            'Nama Ayah',
            'Alamat Ayah',
            'No. HP Ayah',
            'Tempat Lahir Ayah',
            'Tanggal Lahir Ayah',
            'Pekerjaan Ayah',
            'Pendapatan Ayah',

            // Data Ibu (Wali Perempuan)
            'Nama Ibu',
            'Alamat Ibu',
            'No. HP Ibu',
            'Tempat Lahir Ibu',
            'Tanggal Lahir Ibu',
            'Pekerjaan Ibu',
            'Pendapatan Ibu',
        ];
    }

    public function map($pendaftar): array
    {
        $this->counter++;

        $dataDiri = $pendaftar->dataDiriPendaftar;
        $waliList = $dataDiri ? $dataDiri->wali : collect();

        // Ayah = Wali dengan gender Laki-Laki
        $ayah = $waliList->firstWhere('gender', 'Laki-Laki');
        // Ibu = Wali dengan gender Perempuan
        $ibu = $waliList->firstWhere('gender', 'Perempuan');

        // Status pembayaran
        $payment = $this->pembayaran->firstWhere('user_id', $pendaftar->user_id);
        $formStatus = $pendaftar->verification_status ?? null;
        $paymentStatus = $payment->verification_status ?? null;

        $overallStatus = $this->getDashboardStatus($formStatus, $paymentStatus);

        return [
            // Data Periode
            $this->periode->name,
            \Carbon\Carbon::parse($this->periode->startDate)->format('d/m/Y'),
            \Carbon\Carbon::parse($this->periode->endDate)->format('d/m/Y'),

            // Data Pendaftar
            $this->counter,
            optional($pendaftar->user)->name ?? '-',
            $this->formatStatus($formStatus),
            $this->formatStatus($paymentStatus),
            $payment->status_pembayaran ?? '-',
            $this->calculateTotalBiaya($dataDiri, $payment),
            $this->formatOverallStatus($overallStatus),

            // Data Diri
            optional($dataDiri)->gender ?? '-',
            optional($dataDiri)->place_of_birth ?? '-',
            $dataDiri && $dataDiri->date_of_birth
                ? \Carbon\Carbon::parse($dataDiri->date_of_birth)->format('d/m/Y')
                : '-',
            optional($dataDiri)->nisn ?? '-',
            optional($dataDiri)->phone ?? '-',
            optional($dataDiri)->domisili ?? '-',
            optional($dataDiri)->child_number ?? '-',
            optional($dataDiri)->sibling ?? '-',
            optional($dataDiri)->previous_school_name ?? '-',
            optional($dataDiri)->previous_school_address ?? '-',
            ($dataDiri && $dataDiri->kip && $dataDiri->kip !== '-') ? 'Ya' : 'Tidak',

            // Data Ayah
            optional($ayah)->name ?? '-',
            optional($ayah)->address ?? '-',
            optional($ayah)->phone ?? '-',
            optional($ayah)->place_of_birth ?? '-',
            $ayah && $ayah->date_of_birth
                ? \Carbon\Carbon::parse($ayah->date_of_birth)->format('d/m/Y')
                : '-',
            optional($ayah)->pekerjaan ?? '-',
            optional($ayah)->pendapatan ?? '-',

            // Data Ibu
            optional($ibu)->name ?? '-',
            optional($ibu)->address ?? '-',
            optional($ibu)->phone ?? '-',
            optional($ibu)->place_of_birth ?? '-',
            $ibu && $ibu->date_of_birth
                ? \Carbon\Carbon::parse($ibu->date_of_birth)->format('d/m/Y')
                : '-',
            optional($ibu)->pekerjaan ?? '-',
            optional($ibu)->pendapatan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }

    private function getDashboardStatus($formStatus, $paymentStatus): string
    {
        if (is_null($formStatus) && is_null($paymentStatus)) {
            return 'belum_mengisi';
        }

        if ($formStatus === 'verified' && $paymentStatus === 'verified') {
            return 'selesai';
        }

        if ($formStatus === 'rejected' || $paymentStatus === 'rejected') {
            return 'perlu_perbaikan';
        }

        if (
            ($formStatus === 'pending' && $paymentStatus === 'pending') ||
            ($formStatus === 'verified' && $paymentStatus === 'pending')
        ) {
            return 'menunggu_verifikasi';
        }

        return 'belum_mengisi';
    }

    private function formatStatus($status): string
    {
        return match ($status) {
            'verified' => 'Terverifikasi',
            'pending' => 'Menunggu Verifikasi',
            'rejected' => 'Ditolak',
            default => 'Belum Mengisi',
        };
    }

    private function formatOverallStatus($status): string
    {
        return match ($status) {
            'selesai' => 'Selesai',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'perlu_perbaikan' => 'Perlu Perbaikan',
            'belum_mengisi' => 'Belum Mengisi',
            default => '-',
        };
    }

    private function calculateTotalBiaya($dataDiri, $payment): string
    {
        $statusPembayaran = $payment->status_pembayaran ?? 'Belum Lunas';

        // Belum Lunas atau kosong → tampilkan -
        if ($statusPembayaran === 'Belum Lunas' || !$this->infoPembayaran) {
            return '-';
        }

        $administrasi = $this->infoPembayaran->biaya_administrasi ?? [];
        $atribut = $this->infoPembayaran->biaya_atribut ?? [];

        $totalAdministrasi = collect($administrasi)->sum('jumlah');

        // Tentukan atribut berdasarkan gender pendaftar
        $gender = optional($dataDiri)->gender;
        if ($gender === 'Laki-Laki') {
            $totalAtribut = collect($atribut)->sum('putra');
        } elseif ($gender === 'Perempuan') {
            $totalAtribut = collect($atribut)->sum('putri');
        } else {
            $totalAtribut = 0;
        }

        $grandTotal = $totalAdministrasi + $totalAtribut;

        if ($statusPembayaran === '50%') {
            // Bayar 50% dari total
            $grandTotal = $grandTotal * 0.5;
        } elseif ($statusPembayaran === 'Lunas') {
            // Lunas mendapat potongan diskon
            $potongan = $this->infoPembayaran->potongan_lunas ?? 0;
            $grandTotal = $grandTotal - $potongan;
        }

        return 'Rp ' . number_format($grandTotal, 0, ',', '.');
    }
}
