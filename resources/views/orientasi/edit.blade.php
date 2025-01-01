<x-app-layout>

    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-semibold mb-4">Edit Jadwal Orientasi</h2>
                </div>
                <form action="{{ route('orientasi.update', $orientasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="id_periode" class="block text-sm font-medium text-gray-700">Periode PPDB</label>
                        <select value="{{$orientasi->id_periode}}" name="id_periode" id="id_periode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($periodePPDB as $periode )
                            <option value={{$periode->id_periode}}>{{$periode->name}}: {{ date('F Y', strtotime($periode->startDate)) . ' - ' . date('F Y', strtotime($periode->endDate)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="datetime_start" class="block text-sm font-medium text-gray-700">Mulai</label>
                        <input value="{{$orientasi->datetime_start}}" type="datetime-local" name="datetime_start" id="datetime_start" class="mt-1 p-2 w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="datetime_end" class="block text-sm font-medium text-gray-700">Selesai</label>
                        <input value="{{$orientasi->datetime_end}}" type="datetime-local" name="datetime_end" id="datetime_end" class="mt-1 p-2 w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="kegiatan" class="block text-sm font-medium text-gray-700">Kegiatan</label>
                        <input value="{{$orientasi->kegiatan}}" type="text" name="kegiatan" id="kegiatan" class="mt-1 p-2 w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="mt-1 p-2 w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{$orientasi->keterangan}}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>