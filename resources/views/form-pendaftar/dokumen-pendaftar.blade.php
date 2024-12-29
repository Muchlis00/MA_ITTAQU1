@extends('form-pendaftar.index')

@section('form-pendaftar')
@php
$formFields = [
['name'=> 'Ijazah',
'key' =>'ijazah',
'value' => $currentDataDiriPendaftar->ijazah],
['name'=> 'Foto',
'key' =>'photo',
'value' => $currentDataDiriPendaftar->photo],
['name'=> 'Akte Kelahiran',
'key' =>'akte_kelahiran',
'value' => $currentDataDiriPendaftar->akte_kelahiran],
['name'=> 'KIP',
'key' =>'kip',
'value' => $currentDataDiriPendaftar->kip],
];
@endphp
<form action="{{ route('formulir-ppdb.storeDokumenPendaftar') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="data_diri_pendaftar_id" value={{ $currentDataDiriPendaftar->id }}>
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Dokumen Pendaftar</h3>
    <div class="gap-[3em] flex flex-col">
        <div class="bg-gray-50 grid grid-cols-1 gap-6 p-4 rounded-md mb-6">

            @foreach ($formFields as $field)
            <div class="flex flex-row items-center gap-4">
                <label for={{ $field['key'] }} class="w-32 whitespace-nowrap text-sm font-medium text-gray-700">{{ $field['name'] }}</label>
                <input type="file" accept="image/*" name={{ $field['key'] }} id={{ $field['key'] }}
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @if ($field['value'])
                <div class="max-w-xs">
                    <img alt={{ $field['name'] }} src={{ asset('storage/' . $field['value']) }} class="rounded-md shadow" style="max-width: 10em; max-height: 10em;">
                </div>
                @endif
            </div>
            @endforeach


        </div>
    </div>


    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Simpan
        </button>
    </div>
</form>
@endsection