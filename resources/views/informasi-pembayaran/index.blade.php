<x-app-layout>
    <style>
.required {
    color: red;
}
</style>
@if(session()->has('success'))
    <script>
        alert("Data berhasil disimpan!");
    </script>
@endif

<div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Pembayaran PPDB</h2>
            
            <form class="space-y-6" method="POST" action="{{ route('informasi-pembayaran.store') }}">
                <div class="mb-4">
    <p class="text-sm text-gray-600">
        <span class="required">*</span>
        Menandakan kolom yang wajib diisi.
    </p>
</div>
                @csrf
                <div class="bg-gray-50 p-4 rounded-md border border-gray-200 flex items-center">
                    <label for="id_periode" class="w-32 block text-sm font-medium text-gray-700">Periode PPDB</label>
                    <select onchange="handlePeriodeChange()" name="id_periode" id="id_periode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach ($periodePPDB as $periode)
                        <option value="{{ $periode->id_periode }}">{{ $periode->name }}: {{ date('F Y', strtotime($periode->startDate)) . ' - ' . date('F Y', strtotime($periode->endDate)) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Biaya Administrasi Madrasah <span class="required">*</span></h3>
                            <button type="button" onclick="addAdministrasiRow()" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold py-1.5 px-3 rounded flex items-center transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Item
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase">
                                        <th class="py-2 pr-2">Jenis Administrasi</th>
                                        <th class="py-2 px-2 w-36">Jumlah (Rp)</th>
                                        <th class="py-2 pl-2 w-12 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="administrasi-tbody" class="divide-y divide-gray-200">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                            <h3 class="text-lg font-bold text-gray-900"> Biaya Atribut Siswa / Siswi <span class="required">*</span></h3>
                            <button type="button" onclick="addAtributRow()" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold py-1.5 px-3 rounded flex items-center transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Item
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase">
                                        <th class="py-2 pr-2">Jenis Perlengkapan</th>
                                        <th class="py-2 px-2 w-28">Putra (Rp)</th>
                                        <th class="py-2 px-2 w-28">Putri (Rp)</th>
                                        <th class="py-2 pl-2 w-12 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="atribut-tbody" class="divide-y divide-gray-200">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Diskon <span class="required">*</span></h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="potongan_lunas" class="block text-sm font-medium text-gray-700">Potongan Pembayaran Lunas (Rp)</label>
                            <input type="number" name="potongan_lunas" id="potongan_lunas" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const defaultAdministrasi = [];
    const defaultAtribut = [];

    let adminIndex = 0;
    let atributIndex = 0;

    function renderAdministrasi(items) {
        const tbody = document.getElementById('administrasi-tbody');
        tbody.innerHTML = '';
        adminIndex = 0;
        
        items.forEach(item => {
            addAdministrasiRow(item.nama, item.jumlah);
        });
    }

    function addAdministrasiRow(nama = '', jumlah = '') {
        const tbody = document.getElementById('administrasi-tbody');
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.innerHTML = `
            <td class="py-2 pr-2">
                <input type="text" name="biaya_administrasi[${adminIndex}][nama]" value="${nama}" placeholder="Nama administrasi..." class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </td>
            <td class="py-2 px-2">
                <input type="number" name="biaya_administrasi[${adminIndex}][jumlah]" value="${jumlah}" placeholder="0" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </td>
            <td class="py-2 pl-2 text-center">
                <button type="button" onclick="this.closest('tr').remove()" class="text-red-600 hover:text-red-900 p-1 font-semibold text-sm transition">
                    Hapus
                </button>
            </td>
        `;
        tbody.appendChild(row);
        adminIndex++;
    }

    function renderAtribut(items) {
        const tbody = document.getElementById('atribut-tbody');
        tbody.innerHTML = '';
        atributIndex = 0;

        items.forEach(item => {
            addAtributRow(item.nama, item.putra, item.putri);
        });
    }

    function addAtributRow(nama = '', putra = '', putri = '') {
        const tbody = document.getElementById('atribut-tbody');
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.innerHTML = `
            <td class="py-2 pr-2">
                <input type="text" name="biaya_atribut[${atributIndex}][nama]" value="${nama}" placeholder="Nama perlengkapan..." class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </td>
            <td class="py-2 px-2">
                <input type="number" name="biaya_atribut[${atributIndex}][putra]" value="${putra}" placeholder="0" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </td>
            <td class="py-2 px-2">
                <input type="number" name="biaya_atribut[${atributIndex}][putri]" value="${putri}" placeholder="0" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </td>
            <td class="py-2 pl-2 text-center">
                <button type="button" onclick="this.closest('tr').remove()" class="text-red-600 hover:text-red-900 p-1 font-semibold text-sm transition">
                    Hapus
                </button>
            </td>
        `;
        tbody.appendChild(row);
        atributIndex++;
    }

    function handlePeriodeChange() {
        let periodeId = document.querySelector("#id_periode").value;
        let url = "{{ route('informasi-pembayaran.show', ':periodeId') }}".replace(':periodeId', periodeId);

        const data = {
            _token: '{{ csrf_token() }}',
        };

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                const infoAdm = (data && data.biaya_administrasi && data.biaya_administrasi.length > 0) ? data.biaya_administrasi : defaultAdministrasi;
                const infoAtr = (data && data.biaya_atribut && data.biaya_atribut.length > 0) ? data.biaya_atribut : defaultAtribut;
                
                renderAdministrasi(infoAdm);
                renderAtribut(infoAtr);

                document.querySelector("#potongan_lunas").value = data?.potongan_lunas ?? 150000;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                renderAdministrasi(defaultAdministrasi);
                renderAtribut(defaultAtribut);
                document.querySelector("#potongan_lunas").value = 150000;
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        handlePeriodeChange();
    });
</script>
</x-app-layout>