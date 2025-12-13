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
            <table class="simple-datatables w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Periode</th>
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

                        <th class="px-4 py-2">Status Formulir</th>
                        <th class="px-4 py-2">Status Pendaftaran</th>

                        <th class="hidden">Pembayaran</th>
                        <th class="hidden">Status Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pendaftar as $item)
                    @php
                        $pembayaranItem = $pembayaran->firstWhere('user_id', $item->user_id);
                    @endphp

                    <tr>
                        <td class="border px-4 py-2">
                            {{ $item->periode->name }}
                            ({{ \Carbon\Carbon::parse($item->periode->startDate)->format('d-m-Y') }}
                            -
                            {{ \Carbon\Carbon::parse($item->periode->endDate)->format('d-m-Y') }})
                        </td>

                        <td class="border px-4 py-2">{{ $item->user->name }}</td>

                        <td class="hidden">{{ $item->dataDiriPendaftar->nisn ?? null }}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->gender ?? null}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->place_of_birth ?? null }}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->date_of_birth ?? null}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->phone ?? null}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->child_number ?? null}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->sibling ?? null}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->previous_school_name ?? null}}</td>
                        <td class="hidden">{{ $item->dataDiriPendaftar->previous_school_address ?? null }}</td>

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

                        <td class="border px-4 py-2">
                            {{ $item->ready_to_verify ? 'Sudah kirim' : 'Telah Terverifikasi' }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $item->verification_status }}
                        </td>

                        <td class="hidden">{{ $pembayaranItem->status_pembayaran ?? '-' }}</td>
                        <td class="hidden">{{ $pembayaranItem->verification_status ?? '-' }}</td>
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
