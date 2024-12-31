<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col space-y-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="shadow overflow-hidden rounded border-b border-gray-200 mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Jadwal Masa Orientasi Siswa</h3>
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr class="text-left">
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Kegiatan</th>
                                <th class="px-4 py-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orientasi as $item)
                            <tr class="odd:bg-gray-100 even:bg-white hover:bg-gray-200">
                                <td class="border px-4 py-2">
                                    @php
                                    $startDate = Carbon\Carbon::parse($item->datetime_start);
                                    $endDate = Carbon\Carbon::parse($item->datetime_end);
                                    @endphp

                                    @if ($startDate->format('Y-m-d') == $endDate->format('Y-m-d'))
                                    {{ $startDate->format('j F Y') }} {{ $startDate->format('H:i') }} - {{ $endDate->format('H:i') }}
                                    @else
                                    {{ $startDate->format('j F Y') }} {{ $startDate->format('H:i') }} - {{ $endDate->format('j F Y') }} {{ $endDate->format('H:i') }}
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $item->kegiatan }}</td>
                                <td class="border px-4 py-2">{{ $item->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Registration Status Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Status Verifikasi Data & Dokumen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border rounded-lg p-4">
                            <p class="text-sm text-gray-600">Periode Pendaftaran</p>
                            <p class="font-medium">{{ $pendaftarPPDB->periode->name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($pendaftarPPDB->periode->startDate)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($pendaftarPPDB->periode->endDate)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="border rounded-lg p-4">
                            <p class="text-sm text-gray-600">Status Verifikasi</p>
                            <div class="mt-1">
                                @if($pendaftarPPDB->verification_status === 'pending')
                                <span class="px-2 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                    Menunggu Verifikasi
                                </span>
                                @elseif($pendaftarPPDB->verification_status === 'verified')
                                <span class="px-2 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                    Terverifikasi
                                </span>
                                @else
                                <span class="px-2 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                    Ditolak
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                Tanggal Pendaftaran: {{ \Carbon\Carbon::parse($pendaftarPPDB->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Payment History Section -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Pembayaran</h3>
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($pembayaranPPDB as $index => $pembayaran)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            @if($pembayaran->verification_status === 'verified')
                                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            @elseif($pembayaran->verification_status === 'rejected')
                                            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            @else
                                            <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Pembayaran #{{ $index + 1 }} -
                                                    @if($pembayaran->verification_status === 'verified')
                                                    <span class="font-medium text-green-800">Terverifikasi</span>
                                                    @elseif($pembayaran->verification_status === 'rejected')
                                                    <span class="font-medium text-red-800">Ditolak</span>
                                                    @else
                                                    <span class="font-medium text-yellow-800">Menunggu Verifikasi</span>
                                                    @endif
                                                </p>
                                                <p class="mt-1 text-xs text-gray-500">
                                                    Status Pembayaran: {{ $pembayaran->status_pembayaran }}
                                                </p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                <time datetime="{{ $pembayaran->created_at }}">
                                                    {{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d M Y H:i') }}
                                                </time>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Proof Image -->
                                    <div class="mt-3 ml-11">
                                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                            alt="Bukti Pembayaran #{{ $index + 1 }}"
                                            class="h-32 w-auto object-cover rounded shadow-sm hover:shadow-lg transition-shadow duration-200 cursor-pointer"
                                            onclick="window.open(this.src, '_blank')">
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>