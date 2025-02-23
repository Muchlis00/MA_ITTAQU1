@extends('form-pendaftar.index')

@section('form-pendaftar')
<div>
    @if ($currentAgreement && $currentAgreement->content)
    <div class="bg-gray-50 p-4 rounded-md">
        <span>
            Dengan mengisi formulir ini, saya menyatakan bahwa:
        </span>
        <p>
            {!! $currentAgreement->content!!}
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
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Pendaftar</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off" value="{{ $currentUser->name }}">
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select value="{{$currentDataDiriPendaftar->gender}}" autocomplete="off" name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input value="{{$currentDataDiriPendaftar->place_of_birth}}" autocomplete="off" type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input value="{{$currentDataDiriPendaftar->date_of_birth}}" autocomplete="off" type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">Nomor NISN</label>
                    <input value="{{$currentDataDiriPendaftar->nisn}}" autocomplete="off" type="text" name="nisn" id="nisn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon Pendaftar</label>
                    <input value="{{$currentDataDiriPendaftar->phone}}" autocomplete="off" type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="child_number" class="block text-sm font-medium text-gray-700">Anak ke</label>
                    <input value="{{$currentDataDiriPendaftar->child_number}}" autocomplete="off" type="number" name="child_number" id="child_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="sibling" class="block text-sm font-medium text-gray-700">Jumlah Saudara</label>
                    <input value="{{$currentDataDiriPendaftar->sibling}}" autocomplete="off" type="number" name="sibling" id="sibling" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="previous_school_name" class="block text-sm font-medium text-gray-700">Nama Sekolah Asal</label>
                    <input value="{{$currentDataDiriPendaftar->previous_school_name}}" type="text" name="previous_school_name" id="previous_school_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off">
                    <ul id="school-suggestions" class="border border-gray-300 rounded-md mt-1 hidden max-h-48 overflow-y-auto"></ul>
                </div>

                <div>
                    <label for="previous_school_address" class="block text-sm font-medium text-gray-700">Alamat Sekolah Asal</label>
                    <input value="{{$currentDataDiriPendaftar->previous_school_address}}" type="text" name="previous_school_address" id="previous_school_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off" >
                    <!-- <textarea name="previous_school_address" id="previous_school_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off">{{ $currentDataDiriPendaftar->previous_school_address }}</textarea> -->
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



<script>
const schoolNameInput = document.getElementById('previous_school_name');
const schoolSuggestions = document.getElementById('school-suggestions');
const schoolAddressInput = document.getElementById('previous_school_address');

schoolNameInput.addEventListener('input', async (event) => {
    const searchTerm = event.target.value;

    if (searchTerm.length < 3) {
        schoolSuggestions.classList.add('hidden');
        return;
    }

    try {
        const response = await fetch(`https://api-sekolah-indonesia.vercel.app/sekolah/s?sekolah=${searchTerm}`);
        const data = await response.json();

        schoolSuggestions.innerHTML = '';
        if (data && data.dataSekolah && data.dataSekolah.length > 0) { // Periksa data.dataSekolah
            data.dataSekolah.forEach(school => { // Iterasi data.dataSekolah
                const li = document.createElement('li');
                li.textContent = school.sekolah;
                li.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                li.addEventListener('click', () => {
                    schoolNameInput.value = school.sekolah;
                    schoolAddressInput.value = school.alamat_jalan;
                    schoolSuggestions.classList.add('hidden');
                });
                schoolSuggestions.appendChild(li);
            });
        } else {
            const li = document.createElement('li');
            li.textContent = "Sekolah tidak ditemukan";
            li.classList.add('p-2');
            schoolSuggestions.appendChild(li);
        }

        schoolSuggestions.classList.remove('hidden');
    } catch (error) {
        console.error('Error fetching school data:', error);
        schoolSuggestions.innerHTML = '<li class="p-2">Error fetching data</li>';
        schoolSuggestions.classList.remove('hidden');
    }
});

// Event Listener untuk menyembunyikan suggestion saat input kehilangan fokus
schoolNameInput.addEventListener('blur', () => {
    // Tunda sedikit agar event click pada suggestion tetap terproses
    setTimeout(() => {
        schoolSuggestions.classList.add('hidden');
    }, 200);
});

// Event Listener untuk menampilkan suggestion saat input mendapatkan fokus
schoolNameInput.addEventListener('focus', () => {
    if (schoolNameInput.value.length >= 3) {
        schoolSuggestions.classList.remove('hidden');
    }
});
</script>
@endsection