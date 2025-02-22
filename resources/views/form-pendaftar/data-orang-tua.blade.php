@extends('form-pendaftar.index')

@section('form-pendaftar')
<form action="{{ route('formulir-ppdb.storeDataOrangTua') }}" method="POST" class="space-y-6">
    @csrf
    <input type="hidden" name="data_diri_pendaftar_id" value={{$currentDataDiriPendaftar->id}}>
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Orang Tua</h3>
    <div class=" gap-[3em] flex flex-col">


        <div class="bg-gray-50 grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-md mb-6">

            <div class="md:col-span-2">
                <label for="father_name" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                <input type="text" name="father_name" id="father_name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="255" value="{{$currentDataAyah->name}}" required>
            </div>
            <div>
                <label for="father_place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir Ayah</label>
                <input type="text" name="father_place_of_birth" id="father_place_of_birth"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="255" value="{{$currentDataAyah->place_of_birth}}" required>
            </div>
            <div>
                <label for="father_date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir Ayah</label>
                <input type="date" name="father_date_of_birth" id="father_date_of_birth"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{$currentDataAyah->date_of_birth}}" required>
            </div>
            <div>
                <label for="father_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" name="father_job" id="father_job"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="255" value="{{$currentDataAyah->pekerjaan}}" required>
            </div>
            <div>
                <label for="father_income" class="block text-sm font-medium text-gray-700">Pendapatan Ayah</label>
                <input type="number" name="father_income" id="father_income"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    min="0" value="{{$currentDataAyah->pendapatan}}" required>
            </div>
            <div>
                <label for="father_phone" class="block text-sm font-medium text-gray-700">No. Telepon Ayah</label>
                <input type="tel" name="father_phone" id="father_phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="15" value="{{$currentDataAyah->phone}}" required>

            </div>
        </div>

        <div class="bg-gray-50 grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-md mb-6">


            <div class="md:col-span-2">
                <label for="mother_name" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                <input type="text" name="mother_name" id="mother_name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="255" value="{{$currentDataIbu->name}}" required>
            </div>


            <div>
                <label for="mother_place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir Ibu</label>
                <input type="text" name="mother_place_of_birth" id="mother_place_of_birth"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="255" value="{{$currentDataIbu->place_of_birth}}" required>
            </div>

            <div>
                <label for="mother_date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir Ibu</label>
                <input type="date" name="mother_date_of_birth" id="mother_date_of_birth"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{$currentDataIbu->date_of_birth}}" required>
            </div>


            <div>
                <label for="mother_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <input type="text" name="mother_job" id="mother_job"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="255" value="{{$currentDataIbu->pekerjaan}}" required>

            </div>



            <div>
                <label for="mother_income" class="block text-sm font-medium text-gray-700">Pendapatan Ibu</label>
                <input type="number" name="mother_income" id="mother_income"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    min="0" value="{{$currentDataIbu->pendapatan}}" required>

            </div>


            <div>
                <label for="mother_phone" class="block text-sm font-medium text-gray-700">No. Telepon Ibu</label>
                <input type="tel" name="mother_phone" id="mother_phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    maxlength="15" value="{{$currentDataIbu->phone}}" required>

            </div>

            <div class="md:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Tempat Tinggal</label>
                <textarea name="address" id="address" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>{{$currentDataIbu->address}}</textarea>

            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Simpan
        </button>
    </div>
</form>
@endsection