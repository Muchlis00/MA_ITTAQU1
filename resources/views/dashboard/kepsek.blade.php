<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Statistik dan analisis data pendaftar</h1>
        </div>

        <!-- Grid Layout for Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Chart Cards - Each wrapped in a consistent card style -->
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
</x-app-layout>