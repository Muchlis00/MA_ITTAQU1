<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Verifikasi Formulir Pendaftaran</h1>
                        <p class="mt-2 text-sm text-gray-600">Review dan verifikasi data pendaftar PPDB</p>
                    </div>
                    <div class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-lg border border-blue-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-900">{{ count($listPendaftar) }} Menunggu Verifikasi</span>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid gap-6">
                @forelse ($listPendaftar as $pendaftar)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $pendaftar->user->name }}</h3>
                                    <p class="text-blue-100 text-sm">{{ $pendaftar->DataDiriPendaftar->nisn ?? 'NISN: -' }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('verify-formulir.verify', $pendaftar->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menerima pendaftar ini?')">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                                <button
                                    data-id="{{ $pendaftar->id }}"
                                    onclick="openModal(this.dataset.id)"
                                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Tolak
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Content Card -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            
                            <!-- Data Pribadi -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-900">Data Pribadi</h4>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                    <div class="flex justify-between py-1">
                                        <span class="text-gray-600 text-sm">Jenis Kelamin</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->gender ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between py-1">
                                        <span class="text-gray-600 text-sm">Tempat Lahir</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->place_of_birth ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between py-1">
                                        <span class="text-gray-600 text-sm">Tanggal Lahir</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->date_of_birth ? \Carbon\Carbon::parse($pendaftar->DataDiriPendaftar->date_of_birth)->format('d M Y') : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between py-1">
                                        <span class="text-gray-600 text-sm">No. Telepon</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->phone ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between py-1">
                                        <span class="text-gray-600 text-sm">Anak Ke</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->child_number ?? '-' }} dari {{ $pendaftar->DataDiriPendaftar->sibling ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Data Sekolah -->
                                <div class="flex items-center gap-2 mb-3 mt-6">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-900">Sekolah Asal</h4>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                    <div class="py-1">
                                        <span class="text-gray-600 text-sm block mb-1">Nama Sekolah</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->previous_school_name ?? '-' }}</span>
                                    </div>
                                    <div class="py-1">
                                        <span class="text-gray-600 text-sm block mb-1">Alamat Sekolah</span>
                                        <span class="font-medium text-gray-900">{{ $pendaftar->DataDiriPendaftar->previous_school_address ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumen -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-900">Dokumen Pendukung</h4>
                                </div>
                                <div class="space-y-3">
                                    @php
                                        $dokumen = [
                                            ['label' => 'Ijazah', 'file' => $pendaftar->DataDiriPendaftar->ijazah],
                                            ['label' => 'Foto', 'file' => $pendaftar->DataDiriPendaftar->photo],
                                            ['label' => 'Akte Kelahiran', 'file' => $pendaftar->DataDiriPendaftar->akte_kelahiran],
                                            ['label' => 'KIP', 'file' => $pendaftar->DataDiriPendaftar->kip, 'optional' => true],
                                        ];
                                    @endphp
                                    @foreach($dokumen as $dok)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center gap-3">
                                            @if($dok['file'])
                                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $dok['label'] }}</p>
                                                <p class="text-xs text-gray-500">
                                                    @if($dok['file'])
                                                        Tersedia
                                                    @else
                                                        {{ isset($dok['optional']) && $dok['optional'] ? 'Tidak wajib' : 'Belum upload' }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        @if($dok['file'])
                                            <button onclick="lihatDokumen('{{ $dok['file'] }}')" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat
                                            </button>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Data Wali (Full Width) -->
                        <div class="mt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h4 class="text-lg font-semibold text-gray-900">Data Orang Tua / Wali</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                @foreach($pendaftar->wali as $wali)
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-5 border border-gray-200">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 {{ $wali->gender == 'Laki-Laki' ? 'bg-blue-100' : 'bg-pink-100' }} rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 {{ $wali->gender == 'Laki-Laki' ? 'text-blue-600' : 'text-pink-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $wali->gender == 'Laki-Laki' ? 'Ayah' : 'Ibu' }}</p>
                                            <p class="text-sm text-gray-600">{{ $wali->name }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex justify-between py-1 text-sm">
                                            <span class="text-gray-600">Tempat, Tanggal Lahir</span>
                                            <span class="font-medium text-gray-900">{{ $wali->place_of_birth }}, {{ \Carbon\Carbon::parse($wali->date_of_birth)->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex justify-between py-1 text-sm">
                                            <span class="text-gray-600">No. Telepon</span>
                                            <span class="font-medium text-gray-900">{{ $wali->phone }}</span>
                                        </div>
                                        <div class="flex justify-between py-1 text-sm">
                                            <span class="text-gray-600">Pekerjaan</span>
                                            <span class="font-medium text-gray-900">{{ $wali->pekerjaan }}</span>
                                        </div>
                                        <div class="flex justify-between py-1 text-sm">
                                            <span class="text-gray-600">Pendapatan</span>
                                            <span class="font-medium text-gray-900">Rp {{ number_format($wali->pendapatan, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="py-1 text-sm">
                                            <span class="text-gray-600 block mb-1">Alamat</span>
                                            <span class="font-medium text-gray-900">{{ $wali->address }}</span>
                                        </div>
                                    </div>

                                    <!-- Dokumen Wali -->
                                    <div class="mt-4 pt-4 border-t border-gray-300">
                                        <p class="text-sm font-semibold text-gray-700 mb-2">Dokumen</p>
                                        <div class="flex gap-2">
                                            @if($wali->ktp)
                                            <button onclick="lihatDokumen('{{ $wali->ktp }}')" class="flex-1 text-xs bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-50 font-medium">
                                                KTP
                                            </button>
                                            @endif
                                            @if($wali->kartu_keluarga)
                                            <button onclick="lihatDokumen('{{ $wali->kartu_keluarga }}')" class="flex-1 text-xs bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-50 font-medium">
                                                Kartu Keluarga
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Data</h3>
                    <p class="text-gray-600">Tidak ada pendaftar yang menunggu verifikasi saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('verify-formulir.data-rejection-modal')
    
    <script>
        function lihatDokumen(path) {
            let url = "{{ asset('storage/') }}" + "/" + path;
            window.open(url, '_blank');
        }
    </script>
</x-app-layout>