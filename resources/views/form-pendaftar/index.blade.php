<x-app-layout>
<div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900">Formulir Pendaftaran Siswa</h2>
            <div class="text-sm text-gray-700 mb-4">Periode PPDB: {{ date('F Y', strtotime($currentPeriode->startDate)) . ' - ' . date('F Y', strtotime($currentPeriode->endDate)) }}</div>
            <div class="mb-8">
                <div class="flex items-center flex">
                    <!-- Step 1 -->
                    <div class="flex items-center relative flex-col">
                        <div class="{{ Request::is('formulir-ppdb/data-pendaftar') ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full h-12 w-12 flex items-center justify-center text-white font-semibold">
                            1
                        </div>
                        <div class=" w-32 text-center text-sm {{ Request::is('formulir-ppdb/data-pendaftar') ? 'text-blue-600' : 'text-gray-500' }}">Data Pendaftar</div>
                       
                    </div>
                    
                    <!-- Connecting Line -->
                    <div class="flex-1 h-1 mx-4 bg-gray-300"></div>
                    
                    <!-- Step 2 -->
                    <div class="flex items-center relative flex-col">
                        <div class="{{ Request::is('formulir-ppdb/data-orang-tua') ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full h-12 w-12 flex items-center justify-center text-white font-semibold">
                            2
                        </div>
                        <div class=" w-32 text-center text-sm {{ Request::is('formulir-ppdb/data-orang-tua') ? 'text-blue-600' : 'text-gray-500' }}">Data Orang Tua</div>
                        
                    </div>

                    <!-- Connecting Line -->
                    <div class="flex-1 h-1 mx-4 bg-gray-300"></div>
                    
                    <!-- Step 2 -->
                    <div class="flex items-center relative flex-col">
                        <div class="{{ Request::is('dashboard/data-orang-tua') ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full h-12 w-12 flex items-center justify-center text-white font-semibold">
                            3
                        </div>
                        <div class=" w-32 text-center text-sm {{ Request::is('dashboard/data-orang-tua') ? 'text-blue-600' : 'text-gray-500' }}">Pembayaran</div>
                        
                    </div>
                </div>
            </div>
        
            <div class="mt-12">
               @yield('form-pendaftar')
            </div>
        </div>
    </div>
</div>
</x-app-layout>