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
                        <span class="text-sm font-medium text-blue-900">{{ $listPendaftar->total() }} Menunggu Verifikasi</span>
                    </div>
                </div>
            </div>

            <!-- List Pendaftar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                @forelse ($listPendaftar as $index => $pendaftar)
                <div class="border-b border-gray-200 last:border-b-0">
                    <!-- Header List Item -->
                    <button 
                        type="button"
                        onclick="toggleAccordion({{ $index }})"
                        class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors duration-200 focus:outline-none"
                        aria-expanded="false"
                        data-accordion-target="accordion-{{ $index }}">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $pendaftar->user->name }}</h3>
                                <div class="flex items-center gap-4 text-sm text-gray-600">
                                    <span>NISN: {{ $pendaftar->DataDiriPendaftar->nisn ?? '-' }}</span>
                                    <span>•</span>
                                    <span>Jenis Kelamin: {{ $pendaftar->DataDiriPendaftar->gender ?? '-' }}</span>
                                    <span>•</span>
                                    <span>Sekolah: {{ $pendaftar->DataDiriPendaftar->previous_school_name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <svg 
                                id="arrow-{{ $index }}"
                                class="w-5 h-5 text-gray-500 transition-transform duration-200 transform" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>

                    <!-- Accordion Content -->
                    <div 
                        id="accordion-{{ $index }}"
                        class="hidden px-6 pb-6 bg-gray-50 border-t border-gray-200">
                        
                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-3 mb-6 pt-4">
                            <form action="{{ route('verify-formulir.verify', $pendaftar->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menerima pendaftar ini?')">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Terima Pendaftar
                                </button>
                            </form>
                            <button
                                data-id="{{ $pendaftar->id }}"
                                onclick="openModal(this.dataset.id)"
                                class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak Pendaftar
                            </button>
                        </div>

                        <!-- Detail Content -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
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
                                                    [
        'label' => 'KIP',
        'file' => ($pendaftar->DataDiriPendaftar->kip && $pendaftar->DataDiriPendaftar->kip !== '-') 
                    ? $pendaftar->DataDiriPendaftar->kip 
                    : null,
        'optional' => true
    ],
                                                ];
                                            @endphp
                                            @foreach($dokumen as $dok)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                                <div class="flex items-center gap-3">
                                                    @if($dok['file'] )
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
                                                                {{ isset($dok['optional']) && $dok['optional'] ? 'Tidak Memiliki' : 'Belum upload' }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($dok['file'])
                                                    <button onclick="lihatDokumen('{{ $dok['file'] }}', '{{ $dok['label'] }}')" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm">
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

                                        <div class="flex items-center gap-2 mb-3 mt-6">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <h4 class="text-lg font-semibold text-gray-900">Dokumen Rapor</h4>
                                        </div>
                                        <div class="space-y-3">
                                            @php
                                                $raporDocs = [
                                                    ['label' => 'Rapor Semester 1', 'file' => $pendaftar->DataDiriPendaftar->rapor_semester_1 ?? null],
                                                    ['label' => 'Rapor Semester 2', 'file' => $pendaftar->DataDiriPendaftar->rapor_semester_2 ?? null],
                                                    ['label' => 'Rapor Semester 3', 'file' => $pendaftar->DataDiriPendaftar->rapor_semester_3 ?? null],
                                                    ['label' => 'Rapor Semester 4', 'file' => $pendaftar->DataDiriPendaftar->rapor_semester_4 ?? null],
                                                    ['label' => 'Rapor Semester 5', 'file' => $pendaftar->DataDiriPendaftar->rapor_semester_5 ?? null],
                                                ];
                                            @endphp
                                            @foreach($raporDocs as $dok)
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
                                                                Belum upload
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($dok['file'])
                                                    <button onclick="lihatDokumen('{{ $dok['file'] }}', '{{ $dok['label'] }}')" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm">
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

                                <div class="mt-6">
                                    <div class="flex items-center gap-2 mb-4">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 1.343 3 3v9H9v-9c0-1.657 1.343-3 3-3z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8a3 3 0 116 0"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14"></path>
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Nilai Rapor</h4>
                                    </div>

                                    @php
                                        $mapelList = [
                                            'bahasa_indonesia' => 'Bahasa Indonesia',
                                            'matematika' => 'Matematika',
                                            'ipa' => 'IPA (Ilmu Pengetahuan Alam)',
                                            'ips' => 'IPS (Ilmu Pengetahuan Sosial)',
                                            'bahasa_inggris' => 'Bahasa Inggris',
                                        ];
                                        $nilaiRapor = $pendaftar->DataDiriPendaftar->nilai_rapor ?? [];
                                    @endphp

                                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full border border-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-3 py-2 border text-left text-sm font-medium text-gray-700">Mata Pelajaran</th>
                                                        @for ($s = 1; $s <= 5; $s++)
                                                            <th class="px-3 py-2 border text-center text-sm font-medium text-gray-700">Semester {{ $s }}</th>
                                                        @endfor
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white">
                                                    @foreach ($mapelList as $key => $label)
                                                        <tr>
                                                            <td class="px-3 py-2 border text-sm text-gray-700 whitespace-nowrap">{{ $label }}</td>
                                                            @for ($s = 1; $s <= 5; $s++)
                                                                <td class="px-3 py-2 border text-sm text-center text-gray-900">
                                                                    {{ $nilaiRapor[$key]['semester_'.$s] ?? '-' }}
                                                                </td>
                                                            @endfor
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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
                                                    <button onclick="lihatDokumen('{{ $wali->ktp }}', 'KTP {{ $wali->name }}')" class="flex-1 text-xs bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-50 font-medium">
                                                        KTP
                                                    </button>
                                                    @endif
                                                    @if($wali->kartu_keluarga)
                                                    <button onclick="lihatDokumen('{{ $wali->kartu_keluarga }}', 'Kartu Keluarga {{ $wali->name }}')" class="flex-1 text-xs bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-50 font-medium">
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
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Data</h3>
                    <p class="text-gray-600">Tidak ada pendaftar yang menunggu verifikasi saat ini.</p>
                </div>
                @endforelse
            </div>

            @if($listPendaftar->hasPages())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if ($listPendaftar->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $listPendaftar->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Sebelumnya
                            </a>
                        @endif

                        @if ($listPendaftar->hasMorePages())
                            <a href="{{ $listPendaftar->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Selanjutnya
                            </a>
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">
                                Selanjutnya
                            </span>
                        @endif
                    </div>

                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">{{ $listPendaftar->firstItem() ?? 0 }}</span>
                                sampai
                                <span class="font-medium">{{ $listPendaftar->lastItem() ?? 0 }}</span>
                                dari
                                <span class="font-medium">{{ $listPendaftar->total() }}</span>
                                data
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                {{-- Previous Page Link --}}
                                @if ($listPendaftar->onFirstPage())
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $listPendaftar->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @php
                                    $start = max($listPendaftar->currentPage() - 2, 1);
                                    $end = min($start + 4, $listPendaftar->lastPage());
                                    $start = max($end - 4, 1);
                                @endphp

                                @if($start > 1)
                                    <a href="{{ $listPendaftar->url(1) }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        1
                                    </a>
                                    @if($start > 2)
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                    @endif
                                @endif

                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $listPendaftar->currentPage())
                                        <span class="relative inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600 z-10">
                                            {{ $i }}
                                        </span>
                                    @else
                                        <a href="{{ $listPendaftar->url($i) }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                            {{ $i }}
                                        </a>
                                    @endif
                                @endfor

                                @if($end < $listPendaftar->lastPage())
                                    @if($end < $listPendaftar->lastPage() - 1)
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                    @endif
                                    <a href="{{ $listPendaftar->url($listPendaftar->lastPage()) }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        {{ $listPendaftar->lastPage() }}
                                    </a>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($listPendaftar->hasMorePages())
                                    <a href="{{ $listPendaftar->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

@include('verify-formulir.data-rejection-modal')

<div id="dokumenModal" class="hidden fixed inset-0 z-[9999]">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeDokumenModal()"></div>
        
        <div id="dokumenPanel" class="absolute top-0 right-0 h-full w-full md:w-1/2 bg-white shadow-2xl transform transition-transform duration-300 ease-in-out translate-x-full">
            <div class="h-full flex flex-col">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900" id="dokumenTitle">Preview Dokumen</h2>
                    </div>
                    <button onclick="closeDokumenModal()" class="rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Content -->
                <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                    <!-- Preview Container -->
                    <div id="previewContainer" class="flex items-center justify-center min-h-[400px] bg-white rounded-lg shadow-inner p-4">
                        <!-- Image Preview -->
                        <img id="dokumenPreview" src="" alt="Preview Dokumen" class="max-w-full max-h-full object-contain mx-auto hidden rounded">
                        
                        <!-- Loading State -->
                        <div id="loadingSpinner" class="hidden">
                            <div class="flex flex-col items-center">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                                <p class="text-gray-600">Memuat dokumen...</p>
                            </div>
                        </div>
                        
                        <!-- Error State -->
                        <div id="errorMessage" class="hidden text-center p-8">
                            <svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Gagal Memuat Dokumen</h3>
                            <p class="text-gray-600">Dokumen tidak dapat ditampilkan. Silakan coba lagi.</p>
                        </div>
                    </div>
                    
                    <!-- File Info -->
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <p id="fileName" class="font-medium text-gray-900 truncate"></p>
                                <p id="fileSize" class="text-sm text-gray-600 mt-1"></p>
                            </div>
                            <a id="downloadLink" href="#" download target="_blank" class="ml-4 flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium whitespace-nowrap">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Unduh
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="border-t border-gray-200 px-6 py-4 bg-white">
                    <div class="flex justify-end">
                        <button onclick="closeDokumenModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAccordion(index) {
            const content = document.getElementById(`accordion-${index}`);
            const arrow = document.getElementById(`arrow-${index}`);
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }

        function lihatDokumen(path, title = 'Dokumen') {
            const fullPath = "{{ asset('storage/') }}" + "/" + path;
            
            document.getElementById('dokumenTitle').textContent = title;
            document.getElementById('fileName').textContent = getFileName(path);
            
            document.getElementById('dokumenPreview').classList.add('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
            document.getElementById('errorMessage').classList.add('hidden');
            
            document.getElementById('downloadLink').href = fullPath;
            
            const modal = document.getElementById('dokumenModal');
            const panel = document.getElementById('dokumenPanel');
            
            modal.style.display = 'block';
            
            document.body.style.overflow = 'hidden';
            
            setTimeout(() => {
                panel.style.transform = 'translateX(0)';
            }, 10);
            
            const img = document.getElementById('dokumenPreview');
            img.src = fullPath;
            
            img.onload = function() {
                document.getElementById('loadingSpinner').classList.add('hidden');
                document.getElementById('dokumenPreview').classList.remove('hidden');
                
                const sizeInKB = Math.round(Math.random() * 2000) + 100;
                document.getElementById('fileSize').textContent = `Ukuran: ${sizeInKB} KB`;
            };
            
            img.onerror = function() {
                document.getElementById('loadingSpinner').classList.add('hidden');
                document.getElementById('errorMessage').classList.remove('hidden');
            };
        }
        
        function closeDokumenModal() {
            const panel = document.getElementById('dokumenPanel');
            const modal = document.getElementById('dokumenModal');
            
            panel.style.transform = 'translateX(100%)';
            
            document.body.style.overflow = '';
            
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
        
        function getFileName(path) {
            return path.split('/').pop();
        }
        
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDokumenModal();
            }
        });
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
        
        .transition-transform {
            transition: transform 200ms ease-in-out;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        #dokumenModal {
            position: fixed !important;
            z-index: 99999 !important;
            pointer-events: auto !important;
        }
        
        #dokumenPanel {
            position: fixed !important;
            right: 0 !important;
            top: 0 !important;
        }
        
        @media (min-width: 768px) {
            #dokumenPanel {
                width: 50% !important;
            }
        }
        
        @media (max-width: 767px) {
            #dokumenPanel {
                width: 100% !important;
            }
        }
    </style>
