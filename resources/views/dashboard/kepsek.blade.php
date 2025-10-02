<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header Section dengan Filter -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Statistik dan analisis data pendaftar</h1>
                
                <!-- Filter Section -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Filter Periode -->
                    <div class="relative">
                        <form method="GET" action="{{ route('dashboard') }}" id="filterForm">
                            <select name="periode" onchange="updateFilter()" 
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md bg-white">
                                <option value="all" {{ $selectedPeriode == 'all' ? 'selected' : '' }}>Semua Periode</option>
                                @foreach($periodeList as $periode)
                                    <option value="{{ $periode->id_periode }}" 
                                        {{ $selectedPeriode == $periode->id_periode ? 'selected' : '' }}
                                        {{ $periodeAktif && $periodeAktif->id_periode == $periode->id_periode ? 'data-aktif="true"' : '' }}>
                                        {{ $periode->name }} 
                                        ({{ \Carbon\Carbon::parse($periode->startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($periode->endDate)->format('d M Y') }})
                                        @if($periodeAktif && $periodeAktif->id_periode == $periode->id_periode)
                                            ⭐ Aktif
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Reset Filter -->
                    <button onclick="resetFilter()" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Reset
                    </button>
                </div>
            </div>

            <!-- Info Filter Aktif -->
            @if($selectedPeriode != 'all')
            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                <p class="text-sm text-blue-700">
                    <strong>Filter Aktif:</strong>
                    @php
                        $periodeTerpilih = $periodeList->where('id_periode', $selectedPeriode)->first();
                    @endphp
                    Periode: {{ $periodeTerpilih->name ?? 'Tidak Diketahui' }}
                    ({{ \Carbon\Carbon::parse($periodeTerpilih->startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($periodeTerpilih->endDate)->format('d M Y') }})
                    @if($periodeAktif && $periodeAktif->id_periode == $selectedPeriode)
                        <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">⭐ Periode Aktif</span>
                    @endif
                </p>
            </div>
            @elseif($periodeAktif)
            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-md">
                <p class="text-sm text-green-700">
                    <strong>Menampilkan:</strong> Semua Periode 
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Periode Aktif: {{ $periodeAktif->name }}</span>
                </p>
            </div>
            @endif
        </div>

        <!-- Grid Layout for Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Chart Cards -->
            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Grafik Pendaftar</h2>
                <div class="h-64">
                    <x-chartjs-component :chart="$PendaftarChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Status Pendaftar</h2>
                <div class="h-64">
                    <x-chartjs-component :chart="$uncompleteRegistrationChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Distribusi Gender</h2>
                <div class="h-64">
                    <x-chartjs-component :chart="$genderChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Sekolah Asal</h2>
                <div class="h-64">
                    <x-chartjs-component :chart="$previousSchoolChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Rata-Rata Penghasilan Orang Tua</h2>
                <div class="h-64">
                    <x-chartjs-component :chart="$averageIncomeChart" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Penerima KIP</h2>
                <div class="h-64">
                    <x-chartjs-component :chart="$kipChart" />
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFilter() {
            const form = document.getElementById('filterForm');
            const periode = form.querySelector('[name="periode"]').value;
            
            // Update URL dengan parameter filter
            const url = new URL(window.location.href);
            url.searchParams.set('periode', periode);
            
            window.location.href = url.toString();
        }

        function resetFilter() {
            const url = new URL(window.location.href);
            url.searchParams.delete('periode');
            
            window.location.href = url.toString();
        }

        // Auto-submit form ketika filter berubah
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.querySelector('[name="periode"]');
            select.addEventListener('change', function() {
                document.body.style.cursor = 'wait';
            });
        });
    </script>
</x-app-layout>