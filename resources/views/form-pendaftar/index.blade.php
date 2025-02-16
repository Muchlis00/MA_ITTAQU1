<x-app-layout>
@if(session()->has('success'))
    <script>
        alert("Data berhasil disimpan!"); // Ganti dengan pesan yang sesuai
    </script>
    @endif
    @php
    $steps = [
    ['name'=> 'Data Pendaftar', 'route' => 'formulir-ppdb.dataPendaftar'],
    ['name'=> 'Dokumen Pendaftar', 'route' => 'formulir-ppdb.dokumenPendaftar'],
    ['name'=> 'Data Orang Tua', 'route' => 'formulir-ppdb.dataOrangTua'],
    ['name'=> 'Dokumen Orang Tua', 'route' => 'formulir-ppdb.dokumenOrangTua'],
    ['name'=> 'Pembayaran', 'route' => 'formulir-ppdb.pembayaran'],
    ];

    $currentStepIndex = collect($steps)->search(function ($step) {
    return Request::routeIs($step['route']);
    });

    $prevStep = $currentStepIndex > 0 ? $steps[$currentStepIndex - 1] : null;
    $nextStep = $currentStepIndex < count($steps) - 1 ? $steps[$currentStepIndex + 1] : null;
        @endphp

        <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900">Formulir Pendaftaran Siswa</h2>
                <div class="text-sm text-gray-700 mb-4">Periode PPDB: {{ date('F Y', strtotime($currentPeriode->startDate)) . ' - ' . date('F Y', strtotime($currentPeriode->endDate)) }}</div>

                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        @foreach ($steps as $index => $step)
                        <a class="flex items-center relative flex-col" href="{{ route($step['route']) }}">
                            <div class="{{ Request::routeIs($step['route']) ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full h-12 w-12 flex items-center justify-center text-white font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <div class="text-center text-sm mt-4 {{ Request::routeIs($step['route']) ? 'text-blue-600' : 'text-gray-500' }}">
                                {{ $step['name'] }}
                            </div>
                        </a>
                        @if ($index < count($steps) - 1)
                            <div class="flex-1 h-1 bg-gray-300 rounded">
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="mt-12">
                @yield('form-pendaftar')
            </div>

            <div class="mt-8 flex justify-between">
                @if ($prevStep)
                <a href="{{ route($prevStep['route']) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Kembali
                </a>
                @else
                <span class="bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-md cursor-not-allowed">
                    Kembali
                </span>
                @endif

                @if ($nextStep)
                <a href="{{ route($nextStep['route']) }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Selanjutnya
                </a>
                @else
                <form action={{ route('formulir-ppdb.kirimFormulir') }} method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Kirim Formulir
                    </button>
                    
                </form>
                @endif
            </div>
        </div>
        </div>
        </div>
</x-app-layout>