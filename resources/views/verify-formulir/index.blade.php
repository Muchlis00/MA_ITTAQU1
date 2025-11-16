<style>
.dataTable-dropdown select {
  appearance: none !important;
  padding: 0.25rem 0rem 0.25rem 0.5rem !important;
  border: 1px solid #d1d5db !important; /* gray-300 */
  border-radius: 0.375rem !important; /* rounded-md */
  background-color: white !important;
  //background-image: url("data:image/svg+xml,%3Csvg fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") !important;
  background-repeat: no-repeat !important;
  background-position: right 0.2rem center !important;
  background-size: 1em !important;
  width: auto !important;
  min-width: 3rem !important;
  font-size: 0.875rem !important; /* text-sm */
}
</style>
<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900">Verifikasi Formulir Pendaftaran PPDB</h2>
                <div class="mt-12">
                    <table class="simple-datatables w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Data Pribadi</th>
                                <th class="px-4 py-2">Data Sekolah</th>
                                <th class="px-4 py-2">Dokumen</th>
                                <th class="px-4 py-2">Data Wali</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPendaftar as $pendaftar)
                            <tr>
                                <td class="border px-4 py-2">{{ $pendaftar->user->name }}</td>
                                <td class="border px-4 py-2">
                                    <ul class="list-disc list-inside">
                                        <li>Gender: {{ $pendaftar->DataDiriPendaftar->gender }}</li>
                                        <li>TTL: {{ $pendaftar->DataDiriPendaftar->place_of_birth }}, {{ $pendaftar->DataDiriPendaftar->date_of_birth }}</li>
                                        <li>NISN: {{ $pendaftar->DataDiriPendaftar->nisn }}</li>
                                        <li>Telepon: {{ $pendaftar->DataDiriPendaftar->phone }}</li>
                                        <li>Anak ke-{{ $pendaftar->DataDiriPendaftar->child_number }} dari {{ $pendaftar->DataDiriPendaftar->sibling }}</li>
                                    </ul>
                                </td>
                                <td class="border px-4 py-2">
                                    <ul class="list-disc list-inside">
                                        <li>Asal Sekolah: {{ $pendaftar->DataDiriPendaftar->previous_school_name }}</li>
                                        <li>Alamat Sekolah: {{ $pendaftar->DataDiriPendaftar->previous_school_address }}</li>
                                    </ul>
                                </td>
                                <td class="border px-4 py-2">
                                    <ul class="list-disc list-inside">
                                        <li>Ijazah:
                                            @if($pendaftar->DataDiriPendaftar->ijazah)
                                            <button onclick="lihatDokumen('{{ $pendaftar->DataDiriPendaftar->ijazah }}')" class="text-blue-600 hover:text-blue-800">Lihat</button>
                                            @else
                                            Belum upload
                                            @endif
                                        </li>
                                        <li>Foto:
                                            @if($pendaftar->DataDiriPendaftar->photo)
                                            <button onclick="lihatDokumen('{{ $pendaftar->DataDiriPendaftar->photo }}')" class="text-blue-600 hover:text-blue-800">Lihat</button>
                                            @else
                                            Belum upload
                                            @endif
                                        </li>
                                        <li>Akte:
                                            @if($pendaftar->DataDiriPendaftar->akte_kelahiran)
                                            <button onclick="lihatDokumen('{{ $pendaftar->DataDiriPendaftar->akte_kelahiran }}')" class="text-blue-600 hover:text-blue-800">Lihat</button>
                                            @else
                                            Belum upload
                                            @endif
                                        </li>
                                        <li>KIP:
                                            @if($pendaftar->DataDiriPendaftar->kip)
                                            <button onclick="lihatDokumen('{{ $pendaftar->DataDiriPendaftar->kip }}')" class="text-blue-600 hover:text-blue-800">Lihat</button>
                                            @else
                                            -
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                                <td class="border px-4 py-2">
                                    @foreach($pendaftar->wali as $wali)
                                    <div class="mb-4">
                                        
                                        <p class="font-semibold">{{ $wali->gender == 'Laki-Laki' ? 'Ayah' : 'Ibu' }}:</p>
                                        <ul class="list-disc list-inside">
                                            <li>Nama: {{ $wali->name }}</li>
                                            <li>Gender: {{ $wali->gender }}</li>
                                            <li>TTL: {{ $wali->place_of_birth }}, {{ $wali->date_of_birth }}</li>
                                            <li>Telepon: {{ $wali->phone }}</li>
                                            <li>Pekerjaan: {{ $wali->pekerjaan }}</li>
                                            <li>Pendapatan: Rp {{ number_format($wali->pendapatan, 0, ',', '.') }}</li>
                                            <li>KTP:
                                                @if($wali->ktp)
                                                <button onclick="lihatDokumen('{{ $wali->ktp }}')" class="text-blue-600 hover:text-blue-800">Lihat</button>
                                                @else
                                                Belum upload
                                                @endif
                                            </li>
                                            <li>
                                                @if($wali->kartu_keluarga)
                                                KK: <button onclick="lihatDokumen('{{ $wali->kartu_keluarga }}')" class="text-blue-600 hover:text-blue-800">Lihat</button>
                                                @endif
                                            </li>
                                            <li>Alamat: {{$wali->address}}</li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    {{-- <a class=" text-blue-600 hover:text-blue-800" href={{ route('verify-formulir.show', $pendaftar->id) }}>Lihat</a> --}}
                                    <form action={{ route('verify-formulir.verify', $pendaftar->id) }} method="POST">
                                        @csrf
                                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-2 w-full">
                                            Terima
                                        </button>
                                    </form>
                                    <button
                                        data-id="{{ $pendaftar->id }}"
                                        onclick="openModal(this.dataset.id)"
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full">
                                        Tolak
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('verify-formulir.data-rejection-modal')
    <script>
        function lihatDokumen(path) {
            let url = "{{ asset('storage/') }}" + "/" + path;
            window.open(url, '_blank');
        }
    </script>
    @vite('resources/js/simple-datatables.js')
</x-app-layout>