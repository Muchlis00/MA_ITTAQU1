<x-app-layout>
@if(session()->has('success'))
    <script>
        alert("Data berhasil dihapus!"); // Ganti dengan pesan yang sesuai
    </script>
    @endif
    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-semibold mb-4">Data Orientasi</h2>
                    <a href={{ route('orientasi.create') }} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Jadwal Orientasi</a>
                </div>
                <table class="simple-datatables w-full table-auto">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Datetime</th>
                            <th>Kegiatan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orientasi as $item)
                        <tr>
                            <td>{{ $item->periode->name }}</td>
                            <td>
                                @php
                                $startDate = Carbon\Carbon::parse($item->datetime_start);
                                $endDate = Carbon\Carbon::parse($item->datetime_end);
                                @endphp

                                @if ($startDate->format('Y-m-d') == $endDate->format('Y-m-d'))
                                {{ $startDate->format('j F Y') }} {{ $startDate->format('H:i') }} - {{ $endDate->format('H:i') }}
                                @else
                                {{ $startDate->format('j F Y') }} {{ $startDate->format('H:i') }} - {{ $endDate->format('j F Y') }} {{ $endDate->format('H:i') }}
                                @endif
                            </td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <div class="flex justify-between">
                                <a href="{{ route('orientasi.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <form action="{{ route('orientasi.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @vite('resources/js/simple-datatables.js')

</x-app-layout>