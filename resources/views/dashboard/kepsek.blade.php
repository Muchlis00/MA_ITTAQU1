<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-800">Statistik dan Analisis Data Pendaftar</h1>
                
                <!-- Filter Periode -->
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
            
            <!-- Period Information Banner -->
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

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Chart 1: Grafik Pendaftar -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Grafik Pendaftar</h3>
                <div class="h-64">
                    <x-chartjs-component :chart="$PendaftarChart" />
                </div>
            </div>

            <!-- Chart 2: Status Pendaftar -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Status Pendaftar</h3>
                <div class="h-64">
                    <x-chartjs-component :chart="$uncompleteRegistrationChart" />
                </div>
            </div>

            <!-- Chart 3: Distribusi Gender -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Distribusi Gender</h3>
                <div class="h-64">
                    <x-chartjs-component :chart="$genderChart" />
                </div>
            </div>

            <!-- Chart 4: Sekolah Asal -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Sekolah Asal</h3>
                <div class="h-64">
                    <x-chartjs-component :chart="$previousSchoolChart" />
                </div>
            </div>

            <!-- Chart 5: Rata-Rata Penghasilan Orang Tua -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Rata-Rata Penghasilan Orang Tua</h3>
                <div class="h-64">
                    <x-chartjs-component :chart="$averageIncomeChart" />
                </div>
            </div>

            <!-- Chart 6: Penerima KIP -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Penerima KIP</h3>
                <div class="h-64">
                    <x-chartjs-component :chart="$kipChart" />
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Optional: Custom styles for better appearance */
        .chart-container {
            position: relative;
            height: 16rem;
            width: 100%;
        }
    </style>
</x-app-layout>