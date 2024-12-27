<x-app-layout>
    @php
        echo Request::fullUrl();
    @endphp
<div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Formulir Pendaftaran Siswa</h2>
            
            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center">
                    <!-- Step 1 -->
                    <div class="flex items-center relative">
                        <div class="{{ Request::is('dashboard/data-pendaftar') ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full h-12 w-12 flex items-center justify-center text-white font-semibold">
                            1
                        </div>
                        <div class="absolute -bottom-6 w-32 text-center text-sm {{ Request::is('dashboard/data-pendaftar') ? 'text-blue-600' : 'text-gray-500' }}">
                            Data Pendaftar
                        </div>
                    </div>
                    
                    <!-- Connecting Line -->
                    <div class="flex-1 h-1 mx-4 {{ Request::is('dashboard/data-orang-tua') ? 'bg-blue-600' : 'bg-gray-300' }}"></div>
                    
                    <!-- Step 2 -->
                    <div class="flex items-center relative">
                        <div class="{{ Request::is('dashboard/data-orang-tua') ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full h-12 w-12 flex items-center justify-center text-white font-semibold">
                            2
                        </div>
                        <div class="absolute -bottom-6 w-32 text-center text-sm {{ Request::is('dashboard/data-orang-tua') ? 'text-blue-600' : 'text-gray-500' }}">
                            Data Orang Tua
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="mt-12">
               @include('form-pendaftar.data-pendaftar')
            </div>
        </div>
    </div>
</div>
</x-app-layout>