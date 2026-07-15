<style>
.dataTable-dropdown select {
    appearance: none !important;
    padding: 0.25rem 0rem 0.25rem 0.5rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.375rem !important;
    background-color: white !important;
    background-repeat: no-repeat !important;
    background-position: right 0.2rem center !important;
    background-size: 1em !important;
    width: auto !important;
    min-width: 3rem !important;
    font-size: 0.875rem !important;
}
</style>

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
        <div class="bg-white rounded-lg shadow p-4">
            <h1 class="text-2xl font-bold text-gray-900"">Daftar {{ $periodeAktif->name }} Periode
                            ({{ \Carbon\Carbon::parse($periodeAktif->startDate)->format('d-m-Y') }}
                            -
                            {{ \Carbon\Carbon::parse($periodeAktif->endDate)->format('d-m-Y') }})</h1>
            <table class="simple-datatables w-full table-auto">
                <thead>
                    <tr>
                        <th class="hidden">Periode</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="hidden">NISN</th>
                        <th class="hidden">Jenis Kelamin</th>
                        <th class="hidden">Tempat Lahir</th>
                        <th class="hidden">Tanggal Lahir</th>
                        <th class="hidden">No Hp</th>
                        <th class="hidden">Anak Ke</th>
                        <th class="hidden">Jumlah Saudara</th>
                        <th class="hidden">Nama Sekolah Asal</th>
                        <th class="hidden">Alamat Sekolah Asal</th>

                        <th class="hidden">Nama Ayah</th>
                        <th class="hidden">Alamat Ayah</th>
                        <th class="hidden">No Hp</th>
                        <th class="hidden">Tempat Lahir</th>
                        <th class="hidden">Tanggal Lahir</th>
                        <th class="hidden">Jenis Kelamin</th>
                        <th class="hidden">Pekerjaan</th>
                        <th class="hidden">Pendapatan</th>

                        <th class="hidden">Nama Ibu</th>
                        <th class="hidden">Alamat Ibu</th>
                        <th class="hidden">No Hp</th>
                        <th class="hidden">Tempat Lahir</th>
                        <th class="hidden">Tanggal Lahir</th>
                        <th class="hidden">Jenis Kelamin</th>
                        <th class="hidden">Pekerjaan</th>
                        <th class="hidden">Pendapatan</th>

                        <th class="hidden">Status Formulir</th>
                        <th class="hidden">Status Pendaftaran</th>
                        <th class="px-4 py-2">Pembayaran</th>
                        <th class="px-4 py-2">Status Pembayaran</th>
                        <th class="px-4 py-2">Uang yang Dibayarkan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pendaftar as $item)
                    @php
                        $pembayaranItem = $pembayaran->firstWhere('user_id', $item->user_id);
                        
                        $gender = strtolower($item->dataDiriPendaftar->gender ?? '');
                        $isPutri = str_contains($gender, 'perempuan') || str_contains($gender, 'putri');
                        
                        $info = $informasiPembayaran ? $informasiPembayaran->firstWhere('id_periode', $item->id_periode) : null;
                        
                        $administrasi = ($info && !empty($info->biaya_administrasi)) ? $info->biaya_administrasi : [
                            ["jumlah" => 100000], ["jumlah" => 300000], ["jumlah" => 300000], 
                            ["jumlah" => 300000], ["jumlah" => 100000], ["jumlah" => 100000], ["jumlah" => 60000]
                        ];
                        $atribut = ($info && !empty($info->biaya_atribut)) ? $info->biaya_atribut : [
                            ["putra" => 200000, "putri" => 200000],
                            ["putra" => 200000, "putri" => 200000],
                            ["putra" => 25000, "putri" => 25000],
                            ["putra" => 0, "putri" => 150000],
                            ["putra" => 25000, "putri" => 25000],
                            ["putra" => 90000, "putri" => 90000]
                        ];
                        
                        $total_administrasi = collect($administrasi)->sum('jumlah');
                        $total_atribut = $isPutri ? collect($atribut)->sum('putri') : collect($atribut)->sum('putra');
                        $total_biaya = $total_administrasi + $total_atribut;
                        
                        $potongan_lunas = $info ? $info->potongan_lunas : 150000;
                        
                        $statusPembayaran = $pembayaranItem->status_pembayaran ?? 'Belum Bayar';
                        $verificationStatus = $pembayaranItem->verification_status ?? 'Belum Kirim';
                        
                        $uangDibayarkan = 0;
                        if ($verificationStatus === 'verified') {
                            if ($statusPembayaran === 'Lunas') {
                                $uangDibayarkan = $total_biaya - $potongan_lunas;
                            } elseif ($statusPembayaran === '50%') {
                                $uangDibayarkan = $total_biaya * 0.5;
                            }
                        }
                    @endphp

                    <tr>
                        <td class="hidden">
                            {{ $item->periode->name }}
                            ({{ \Carbon\Carbon::parse($item->periode->startDate)->format('d-m-Y') }}
                            -
                            {{ \Carbon\Carbon::parse($item->periode->endDate)->format('d-m-Y') }})
                        </td>

                        <td class="border px-4 py-2">{{ $item->user->name }}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->nisn ?? '-' }}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->gender ?? '-'}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->place_of_birth ?? '-' }}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->date_of_birth ?? '-'}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->phone ?? '-'}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->child_number ?? '-'}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->sibling ?? '-'}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->previous_school_name ?? '-'}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->previous_school_address ?? '-'}}</td>

                        <!-- Data Ayah -->
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->name ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->address ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->phone ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->place_of_birth ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->date_of_birth ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->gender ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->pekerjaan ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Laki-Laki')->pendapatan ?? '-' }}</td>

                        <!-- Data Ibu -->
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->name ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->address ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->phone ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->place_of_birth ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->date_of_birth ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->gender ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->pekerjaan ?? '-' }}</td>
                        <td class="hidden">{{ $item->wali->firstWhere('gender','Perempuan')->pendapatan ?? '-' }}</td>

                        <td class="hidden">
                            {{ $item->ready_to_verify ? 'Sudah kirim' : 'Belum Kirim' }}
                        </td>

                        <td class="hidden">
                            {{ $item->verification_status ?? 'Belum Isi Formulir'}}
                        </td>

                        <td class="border px-4 py-2">{{ $pembayaranItem->status_pembayaran ?? 'Belum Bayar' }}</td>
                        <td class="border px-4 py-2">{{ $pembayaranItem->verification_status ?? 'Belum Kirim' }}</td>
                        <td class="border px-4 py-2">Rp. {{ number_format($uangDibayarkan, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <button
                    class="simple-datatables-export-button bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Export to CSV
                </button>
            </div>
        </div>
    </div>

    @vite('resources/js/simple-datatables.js')
</x-app-layout>
