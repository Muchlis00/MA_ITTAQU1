@extends('form-pendaftar.index')

@section('form-pendaftar')
<div>
    <form action="{{ route('formulir-ppdb.storeNilaiRapor') }}" method="POST" class="space-y-6">
        @csrf

        <h3 class="text-lg font-semibold text-gray-700 mb-4">Nilai Rapor (5 Semester)</h3>

        <div class="bg-gray-50 p-4 rounded-md">
            @php
                $mapelList = [
                    'bahasa_indonesia' => 'Bahasa Indonesia',
                    'matematika' => 'Matematika',
                    'ipa' => 'IPA (Ilmu Pengetahuan Alam)',
                    'ips' => 'IPS (Ilmu Pengetahuan Sosial)',
                    'bahasa_inggris' => 'Bahasa Inggris',
                ];
                $nilaiRapor = $currentDataDiriPendaftar->nilai_rapor ?? [];
            @endphp

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-3 py-2 border text-left text-sm font-medium text-gray-700">Mata Pelajaran</th>
                            @for ($s = 1; $s <= 5; $s++)
                                <th class="px-3 py-2 border text-center text-sm font-medium text-gray-700">Semester {{ $s }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($mapelList as $key => $label)
                            <tr>
                                <td class="px-3 py-2 border text-sm text-gray-700 whitespace-nowrap">{{ $label }}</td>
                                @for ($s = 1; $s <= 5; $s++)
                                    <td class="px-3 py-2 border">
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            max="100"
                                            name="nilai_rapor[{{ $key }}][semester_{{ $s }}]"
                                            class="w-24 mx-auto block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            value="{{ $nilaiRapor[$key]['semester_'.$s] ?? '' }}"
                                        >
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="text-xs text-gray-500 mt-2">Isi nilai 0-100. Boleh dikosongkan jika belum ada.</p>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
