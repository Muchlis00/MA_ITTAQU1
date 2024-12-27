@extends('form-pendaftar.index')

@section('form-content')
<form action="{{ route('form-pendaftar.store-step-two') }}" method="POST" class="space-y-6">
    @csrf
    <div class="bg-gray-50 p-4 rounded-md mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Orang Tua</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Ayah & Ibu -->
            <div>
                <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                <input type="text" name="nama_ayah" id="nama_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                <input type="text" name="nama_ibu" id="nama_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Tempat Tanggal Lahir Ayah & Ibu -->
            <div>
                <label for="ttl_ayah" class="block text-sm font-medium text-gray-700">Tempat & Tanggal Lahir Ayah</label>
                <input type="text" name="ttl_ayah" id="ttl_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="ttl_ibu" class="block text-sm font-medium text-gray-700">Tempat & Tanggal Lahir Ibu</label>
                <input type="text" name="ttl_ibu" id="ttl_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Pekerjaan Ayah & Ibu -->
            <div>
                <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Pendapatan Ayah & Ibu -->
            <div>
                <label for="pendapatan_ayah" class="block text-sm font-medium text-gray-700">Pendapatan Ayah</label>
                <input type="number" name="pendapatan_ayah" id="pendapatan_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="pendapatan_ibu" class="block text-sm font-medium text-gray-700">Pendapatan Ibu</label>
                <input type="number" name="pendapatan_ibu" id="pendapatan_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Alamat dan No Telepon -->
            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Tempat Tinggal</label>
                <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>
            <div>
                <label for="telepon_ortu" class="block text-sm font-medium text-gray-700">No. Telepon Ayah/Ibu</label>
                <input type="tel" name="telepon_ortu" id="telepon_ortu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="flex justify-between">
        <a href="{{ route('form-pendaftar.step-one') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Kembali
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Submit Pendaftaran
        </button>
    </div>
</form>
@endsection