<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-800">Statistik dan Analisis Data Pendaftar</h1>
                
                <div class="flex items-center gap-3">
                    <label for="periode-filter" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                        Filter Periode:
                    </label>
                    <form method="GET" action="{{ route('dashboard') }}" class="w-full md:w-64">
                        <select 
                            name="periode" 
                            id="periode-filter" 
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                            <option value="all" {{ $selectedPeriode == 'all' ? 'selected' : '' }}>
                                Semua Periode
                            </option>
                            @foreach($periodeList as $periode)
                                @php
                                    $isActive = $periodeAktif && $periodeAktif->id_periode == $periode->id_periode;
                                    $startDate = \Carbon\Carbon::parse($periode->startDate)->format('d M Y');
                                    $endDate = \Carbon\Carbon::parse($periode->endDate)->format('d M Y');
                                @endphp
                                <option 
                                    value="{{ $periode->id_periode }}" 
                                    {{ $selectedPeriode == $periode->id_periode ? 'selected' : '' }}
                                    class="{{ $isActive ? 'font-semibold text-green-600' : '' }}"
                                >
                                    {{ $periode->name }} ({{ $startDate }} - {{ $endDate }})
                                    {{ $isActive ? '• Aktif' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            @if($periodeAktif && $selectedPeriode == $periodeAktif->id_periode)
                <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-md">
                    <p class="text-sm text-green-800">
                        <span class="font-semibold">Periode Aktif:</span> 
                        {{ $periodeAktif->name }} 
                        ({{ \Carbon\Carbon::parse($periodeAktif->startDate)->format('d M Y') }} - 
                         {{ \Carbon\Carbon::parse($periodeAktif->endDate)->format('d M Y') }})
                    </p>
                </div>
            @elseif($periodeAktif && $selectedPeriode == 'all')
                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                    <p class="text-sm text-blue-800">
                        <span class="font-semibold">Info:</span> 
                        Menampilkan semua periode. Periode aktif saat ini: {{ $periodeAktif->name }}
                    </p>
                </div>
            @elseif(!$periodeAktif && $selectedPeriode == 'all')
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                    <p class="text-sm text-yellow-800">
                        <span class="font-semibold">Info:</span> 
                        Tidak ada periode yang sedang aktif. Menampilkan semua periode.
                    </p>
                </div>
            @endif
        </div>

        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="summary-card bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-6 text-white border border-blue-400">
                <div class="summary-card-content flex items-center justify-between">
                    <div class="flex-1">
                        <p class="summary-label text-blue-100 text-sm font-medium mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Total Pendaftar
                        </p>
                        <p class="summary-number text-4xl font-extrabold">{{ $pendaftar->count() }}</p>
                        <p class="summary-description text-blue-200 text-xs mt-1">
                            {{ $selectedPeriode == 'all' 
                                ? 'Semua periode' 
                                : ($periodeList->firstWhere('id_periode', $selectedPeriode)->name ?? 'Periode tidak ditemukan') 
                            }}
                        </p>
                    </div>
                    <div class="summary-icon bg-white bg-opacity-20 rounded-full p-3 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="summary-card bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-6 text-white border border-blue-400">
                <div class="summary-card-content flex items-center justify-between">
                    <div class="flex-1">
                        <p class="summary-label text-blue-100 text-sm font-medium mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pendaftar Selesai
                        </p>
                        <p class="summary-number text-4xl font-extrabold">{{ $pendaftar->where('verification_status', 'verified')->count() }}</p>
                        <p class="summary-description text-blue-200 text-xs mt-1">
                            {{ $selectedPeriode == 'all' 
                                ? 'Semua periode' 
                                : ($periodeList->firstWhere('id_periode', $selectedPeriode)->name ?? 'Periode tidak ditemukan') 
                            }}
                        </p>
                    </div>
                    <div class="summary-icon bg-white bg-opacity-20 rounded-full p-3 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="summary-card bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-6 text-white border border-blue-400">
                <div class="summary-card-content flex items-center justify-between">
                    <div class="flex-1">
                        <p class="summary-label text-blue-100 text-sm font-medium mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Menunggu Verifikasi
                        </p>
                        <p class="summary-number text-4xl font-extrabold">{{ $pendaftar->where('verification_status', 'pending')->count() }}</p>
                        <p class="summary-description text-blue-200 text-xs mt-1">
                            {{ $selectedPeriode == 'all' 
                                ? 'Semua periode' 
                                : ($periodeList->firstWhere('id_periode', $selectedPeriode)->name ?? 'Periode tidak ditemukan') 
                            }}
                        </p>
                    </div>
                    <div class="summary-icon bg-white bg-opacity-20 rounded-full p-3 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="summary-card bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-6 text-white border border-blue-400">
                <div class="summary-card-content flex items-center justify-between">
                    <div class="flex-1">
                        <p class="summary-label text-blue-100 text-sm font-medium mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Formulir Perlu Perbaikan
                        </p>
                        <p class="summary-number text-4xl font-extrabold">{{ $pendaftar->where('verification_status', 'rejected')->count() }}</p>
                        <p class="summary-description text-blue-200 text-xs mt-1">
                            {{ $selectedPeriode == 'all' 
                                ? 'Semua periode' 
                                : ($periodeList->firstWhere('id_periode', $selectedPeriode)->name ?? 'Periode tidak ditemukan') 
                            }}
                        </p>
                    </div>
                    <div class="summary-icon bg-white bg-opacity-20 rounded-full p-3 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
             <div class="summary-card bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-6 text-white border border-blue-400">
                <div class="summary-card-content flex items-center justify-between">
                    <div class="flex-1">
                        <p class="summary-label text-blue-100 text-sm font-medium mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Tidak Mengisi Formulir
                        </p>
                        <p class="summary-number text-4xl font-extrabold">{{ $belumMengisiFormulir }}</p>
                        <p class="summary-description text-blue-200 text-xs mt-1">
                            {{ $selectedPeriode == 'all' 
                                ? 'Semua periode' 
                                : ($periodeList->firstWhere('id_periode', $selectedPeriode)->name ?? 'Periode tidak ditemukan') 
                            }}
                        </p>
                    </div>
                    <div class="summary-icon bg-white bg-opacity-20 rounded-full p-3 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 xl:col-span-2">
                <div class="h-80">
                    <x-chartjs-component :chart="$PendaftarChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="h-80">
                    <x-chartjs-component :chart="$uncompleteRegistrationChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="h-80">
                    <x-chartjs-component :chart="$genderChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 xl:col-span-2">
                <div class="h-80">
                    <x-chartjs-component :chart="$domisiliChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 xl:col-span-2">
                <div class="h-80">
                    <x-chartjs-component :chart="$previousSchoolChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="h-80">
                    <x-chartjs-component :chart="$averageIncomeChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="h-80">
                    <x-chartjs-component :chart="$kipChart" />
                </div>
            </div>
        </div>

        <style>
             <style>
        .chart-container {
            position: relative;
            height: 20rem;
            width: 100%;
        }
        
        .bg-white .chart-container {
            min-height: 320px;
        }
        
        @media (max-width: 1024px) {
            .bg-white .chart-container {
                min-height: 280px;
            }
        }
        
        @media (max-width: 768px) {
            .bg-white .chart-container {
                min-height: 240px;
            }
        }

        .summary-card {
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            pointer-events: none;
        }

        .summary-card-content {
            position: relative;
            z-index: 10;
        }

        .summary-icon {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .summary-number {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: -0.02em;
        }

        .summary-label {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .summary-description {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .summary-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }

        .summary-card:hover .summary-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 12px -2px rgba(0, 0, 0, 0.2), 0 4px 8px -2px rgba(0, 0, 0, 0.12);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .summary-card:hover .summary-number {
            animation: float 3s ease-in-out infinite;
        }
    </style>
        </style>
    </div>
</x-app-layout>