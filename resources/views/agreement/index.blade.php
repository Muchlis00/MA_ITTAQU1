<x-app-layout>


    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900">Persyaratan Pendaftaran</h2>
                <div class="bg-gray-50 p-4 rounded-md">
                    <form class="space-y-6 flex flex-col" method="POST" action="{{ route('agreement.store') }}">
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
                            <label for="content" class="w-32  block text-sm font-medium text-gray-700">Persyaratan</label>
                            <div class="w-full">
                                <textarea name="content" id="content" class="pell-editor"></textarea>
                            </div>
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
    let periodeId = document.querySelector("#id_periode").value;
    let url = "{{ route('agreement.show', ':periodeId') }}".replace(':periodeId', periodeId);

    // Data to be sent in the POST request
    const data = {
        _token: '{{ csrf_token() }}', // CSRF token for Laravel
    };

    // Send POST request using fetch
    fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token in headers
            },
            body: JSON.stringify(data),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Set the retrieved content to the Pell editor
            window.setEditorContent(data.content ?? '');
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

// Trigger content update on DOM ready
document.addEventListener('DOMContentLoaded', handlePeriodeChange);
    </script>
    @vite('resources/js/pell.js')

</x-app-layout>