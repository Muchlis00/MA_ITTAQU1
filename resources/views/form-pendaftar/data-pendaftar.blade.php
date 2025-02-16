@extends('form-pendaftar.index')

@section('form-pendaftar')

<div>
    @if ($currentAgreement && $currentAgreement->content)
    <div class="bg-gray-50 p-4 rounded-md">
        <span>
            Dengan mengisi formulir ini, saya menyatakan bahwa:
        </span>
        <p>
        {!! $currentAgreement->content !!}
        </p>
    </div>
    @endif
    <form action={{ route('formulir-ppdb.storeDataPendaftar') }} method="POST" class="space-y-6">
        @csrf
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <input type="hidden" name="periode_id" value="{{ $currentPeriode->id_periode }}">
        <input type="hidden" name="user_id" value="{{ $currentUser->id }}">
        <div class="bg-gray-50 p-4 rounded-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Pendaftar -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Pendaftar</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ $currentUser->name }}">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select value="{{$currentDataDiriPendaftar->gender}}" name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Tempat Lahir Pendaftar -->
                <div>
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input value="{{$currentDataDiriPendaftar->place_of_birth}}" type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Tanggal Lahir Pendaftar -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input value="{{$currentDataDiriPendaftar->date_of_birth}}" type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- NISN -->
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">Nomor NISN</label>
                    <input value="{{$currentDataDiriPendaftar->nisn}}" type="text" name="nisn" id="nisn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon Pendaftar</label>
                    <input value="{{$currentDataDiriPendaftar->phone}}" type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Anak ke & Jumlah Saudara -->
                <div>
                    <label for="child_number" class="block text-sm font-medium text-gray-700">Anak ke</label>
                    <input value="{{$currentDataDiriPendaftar->child_number}}" type="number" name="child_number" id="child_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="sibling" class="block text-sm font-medium text-gray-700">Jumlah Saudara</label>
                    <input value="{{$currentDataDiriPendaftar->sibling}}" type="number" name="sibling" id="sibling" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Data Sekolah Asal -->
                <div>
                    <label for="previous_school_name" class="block text-sm font-medium text-gray-700">Nama Sekolah Asal</label>
                    <input value="{{$currentDataDiriPendaftar->previous_school_name}}" type="text" name="previous_school_name" id="previous_school_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="previous_school_address" class="block text-sm font-medium text-gray-700">Alamat Sekolah Asal</label>
                    <textarea name="previous_school_address" id="previous_school_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $currentDataDiriPendaftar->previous_school_address }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </form>
</div>



@endsection