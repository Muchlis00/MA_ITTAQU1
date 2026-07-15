@extends('form-pendaftar.index')

@section('form-pendaftar')
<style>
    
.suggestions {
    border: 1px solid #d1d5db;
    border-top: none;
    max-height: 200px;
    overflow-y: auto;
    background-color: white;
    position: absolute;
    width: 100%;
    z-index: 1000;
    border-radius: 0 0 0.375rem 0.375rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.suggestions div {
    padding: 0.5rem 1rem;
    cursor: pointer;
    border-bottom: 1px solid #f3f4f6;
}

.suggestions div:hover {
    background-color: #f9fafb;
}

.suggestions div:last-child {
    border-bottom: none;
}
</style>
<div>
    @if ($currentAgreement && $currentAgreement->content)
    <div class="bg-gray-50 p-4 rounded-md">
        <p>
            {!! $currentAgreement->content!!}
        </p>
        <br>
        <strong>
        <span>
            Dengan mengisi formulir ini, saya menyatakan bahwa:
        </span>
        </strong>
    </div>
    @endif
    <form action="{{ route('formulir-ppdb.storeDataPendaftar') }}" method="POST" class="space-y-6">
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
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Pendaftar<span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off" value="{{ $currentUser->name }}">
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin<span class="required">*</span></label>
                    <select value="{{$currentDataDiriPendaftar->gender}}" autocomplete="off" name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- <div>
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input
                        type="text"
                        id="place_of_birth"
                        name="place_of_birth"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Ketik nama kota"
                        list="cityList"
                        autocomplete="off"
                        style="width: 100%;"
                        value="{{$currentDataDiriPendaftar->place_of_birth}}">
                    <datalist id="cityList">
                        @foreach($cities as $city)
                        <option value="{{ $city['city_name'] }}">
                            {{ $city['type'] }} ({{ $city['province'] }})
                        </option>
                        @endforeach
                    </datalist>
                </div> -->
            <div class="relative mb-3">
            <label for="place_of_birth">Tempat Lahir<span class="required">*</span></label>
            <input
                type="text"
                id="place_of_birth"
                name="place_of_birth"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Ketik nama kota"
                
                autocomplete="off"
                value="{{$currentDataDiriPendaftar->place_of_birth}}"
                >
            <div id="city-suggestions" class="suggestions"></div>
             </div>
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->date_of_birth}}" autocomplete="off" type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="{{ now()->subYears(21)->format('Y-m-d')}}">
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">Nomor NISN<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->nisn}}" autocomplete="off" type="text" maxlength="10" name="nisn" id="nisn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon Pendaftar<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->phone}}" autocomplete="off" type="tel" maxlength="13" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="relative">
                    <label for="domisili" class="block text-sm font-medium text-gray-700">Domisili<span class="required">*</span></label>
                    <input
                        type="text"
                        id="domisili"
                        name="domisili"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Ketik nama kota"
                        autocomplete="off"
                        value="{{$currentDataDiriPendaftar->domisili}}"
                    >
                    <div id="domisili-suggestions" class="suggestions"></div>
                </div>

                <div>
                    <label for="child_number" class="block text-sm font-medium text-gray-700">Anak ke<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->child_number}}" autocomplete="off" type="number" name="child_number" id="child_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="sibling" class="block text-sm font-medium text-gray-700">Jumlah Saudara<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->sibling}}" autocomplete="off" type="number" name="sibling" id="sibling" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="previous_school_name" class="block text-sm font-medium text-gray-700">Nama Sekolah Asal<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->previous_school_name}}" type="text" name="previous_school_name" id="previous_school_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off">
                    <ul id="school-suggestions" class="border border-gray-300 rounded-md mt-1 hidden max-h-48 overflow-y-auto"></ul>
                </div>

                <div>
                    <label for="previous_school_address" class="block text-sm font-medium text-gray-700">Alamat Sekolah Asal<span class="required">*</span></label>
                    <input value="{{$currentDataDiriPendaftar->previous_school_address}}" type="text" name="previous_school_address" id="previous_school_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off">
                    <!-- <textarea name="previous_school_address" id="previous_school_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="off">{{ $currentDataDiriPendaftar->previous_school_address }}</textarea> -->
                </div>
            </div>
        </div>
        <div class="bg-gray-50 p-4 rounded-md">
            <strong>
            <span>
                Untuk di didik sebagai Peserta Didik di Madrasah Aliyah ITTAQU Surabaya. Dan saya menyatakan
bahwa : 
            </span>    
            </strong>
            <p>
                1. Menyetujui putra / putri kami untuk di beri materi Pendidikan Agama Islam sesuai dengan kurikulum
Kementerian Agama Republik Indonesia <br>
2. Taat dengan segala bentuk peraturan dan ketentuan yang di keluarkan oleh Madrasah Aliyah dan Yayasan
Pendidikan ITTAQU Surabaya <br>
3. Memenuhi seluruh kewajiban dan kebutuhan Madrash serta bekerjasama dengan pihak Madrasah atau
Yayasan dalam hal pengawasan serta pendidikan putra  / putri kami <br>
4. Hal-hal yang belum tercantum di dalam formulir, akan di tetapkan lebih lanjut oleh pihak Madrasah 
            </p>
        </div>


        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    const cities = [
        @foreach($cities as $city)
            {name: "{{ $city['city_name'] }}", type: "{{ $city['type'] }}", province: "{{ $city['province'] }}" },
        @endforeach
    ];

    const input = document.getElementById('place_of_birth');
    const suggestionsContainer = document.getElementById('city-suggestions');

    input.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        suggestionsContainer.innerHTML = '';

        if (!value) return;

        const filtered = cities.filter(city => city.name.toLowerCase().includes(value));

        filtered.forEach(city => {
            const div = document.createElement('div');
            div.textContent = `${city.type} ${city.name} (${city.province})`;
            div.addEventListener('click', function() {
                input.value = city.name;
                suggestionsContainer.innerHTML = '';
            });
            suggestionsContainer.appendChild(div);
        });
    });

    
    document.addEventListener('click', function(e) {
        if (e.target !== input) {
            suggestionsContainer.innerHTML = '';
        }
    });

    // Domisili autocomplete
    const domisiliInput = document.getElementById('domisili');
    const domisiliSuggestionsContainer = document.getElementById('domisili-suggestions');

    domisiliInput.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        domisiliSuggestionsContainer.innerHTML = '';

        if (!value) return;

        const filtered = cities.filter(city => city.name.toLowerCase().includes(value));

        filtered.forEach(city => {
            const div = document.createElement('div');
            div.textContent = `${city.type} ${city.name} (${city.province})`;
            div.addEventListener('click', function() {
                domisiliInput.value = city.name;
                domisiliSuggestionsContainer.innerHTML = '';
            });
            domisiliSuggestionsContainer.appendChild(div);
        });
    });

    
    document.addEventListener('click', function(e) {
        if (e.target !== domisiliInput) {
            domisiliSuggestionsContainer.innerHTML = '';
        }
    });
});
</script>

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
            if (data && data.dataSekolah && data.dataSekolah.length > 0) { 
                                data.dataSekolah.forEach(school => { 
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

    
    schoolNameInput.addEventListener('blur', () => {
    
        setTimeout(() => {
            schoolSuggestions.classList.add('hidden');
        }, 200);
    });

    
    schoolNameInput.addEventListener('focus', () => {
        if (schoolNameInput.value.length >= 3) {
            schoolSuggestions.classList.remove('hidden');
        }
    });
</script>
<script>
const tanggalInput = document.getElementById('date_of_birth');
const today = new Date();

const maxDate = new Date(today.getFullYear() - 13, today.getMonth(), today.getDate());

const minDate = new Date(today.getFullYear() - 21, today.getMonth(), today.getDate());

const formatDate = (date) => date.toISOString().split('T')[0];

tanggalInput.min = formatDate(minDate); 
tanggalInput.max = formatDate(maxDate); 


 </script>


<script>
    
const minInput = document.getElementById("child_number");
const maxInput = document.getElementById("sibling");

minInput.addEventListener("input", function() {
    if (parseInt(this.value) > parseInt(maxInput.value)) {
        maxInput.value = this.value; 
    }
});

maxInput.addEventListener("input", function() {
    if (parseInt(this.value) < parseInt(minInput.value)) {
        minInput.value = this.value; 
    }
});

</script>
@endsection