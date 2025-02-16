<x-app-layout>
@if(session()->has('success'))
    <script>
        alert("Data berhasil disimpan!"); // Ganti dengan pesan yang sesuai
    </script>
    @endif

    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900">Informasi Pembayaran PPDB</h2>
                <div class="bg-gray-50 p-4 rounded-md">
                    <form class="space-y-6 flex flex-col" method="POST" action="{{ route('informasi-pembayaran.store') }}">
                        @csrf
                        <div class="flex items-center">
                            <label for="id_periode" class="w-32  block text-sm font-medium text-gray-700">Periode PPDB</label>
                            <select onchange="handlePeriodeChange()" value="{{$periodePPDB[0]->id_periode}}" name="id_periode" id="id_periode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($periodePPDB as $periode )
                                <option value={{$periode->id_periode}}>{{$periode->name}}: {{ date('F Y', strtotime($periode->startDate)) . ' - ' . date('F Y', strtotime($periode->endDate)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center">
                            <label for="detail_pembayaran" class="w-32  block text-sm font-medium text-gray-700">Rincian Pembayaran</label>
                            <textarea name="detail_pembayaran" id="detail_pembayaran" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" ></textarea>
                        </div>

                        
                            <button type="submit" class=" bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Simpan
                            </button>
                        
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function handlePeriodeChange() {
            let periodeId = document.querySelector("#id_periode").value
            let url = "{{ route('informasi-pembayaran.show', ':periodeId') }}".replace(':periodeId', periodeId);

            // Data to be sent in the POST request
            const data = {
                _token: '{{ csrf_token() }}', // CSRF token for Laravel
            };

            // Send POST request using fetch
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers as well
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    console.log(response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    document.querySelector("#detail_pembayaran").value = data.detail_pembayaran ?? ""
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
document.addEventListener('DOMContentLoaded', handlePeriodeChange);
    </script>
</x-app-layout>