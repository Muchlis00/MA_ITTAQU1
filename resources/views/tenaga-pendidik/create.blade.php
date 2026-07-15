@extends('layouts.navbar')
@section('content')
<style>
.required {
    color: red;
}
</style>
<div class="container">
    @if(session()->has('success'))
    <script>
        alert("Data berhasil disimpan!");
    </script>
    @endif
    <h1>Tambah Guru</h1>
    <div class="mb-4">
    <p class="text-sm text-gray-600">
        <span class="required">*</span>
        Menandakan kolom yang wajib diisi.
    </p>
</div>
    <form action="{{ route('tenaga-pendidik.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label><span id="required" class="required">*</span>
            <input type="number" name="nip" class="form-control" id="nip" maxlength="16" minlength="16" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label><span id="required" class="required">*</span>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama </label><span id="required" class="required">*</span>
            <input type="text" text-transform="lowercase" name="nama_guru" class="form-control" id="nama_guru" required>
        </div>
         <div class="mb-3">
            <label for="tempat_guru">Tempat Lahir</label><span id="required" class="required">*</span>
            <input
                type="text"
                id="tempat_guru"
                name="tempat_guru"
                class="form-control"
                placeholder="Ketik nama kota"
                autocomplete="off">
            <div id="city-suggestions" class="suggestions"></div>
        </div>
        <div class="mb-3">
            <label for="tgl_guru" class="form-label">Tanggal Lahir</label><span id="required" class="required">*</span>
            <input type="date" name="tgl_guru" class="form-control" id="tgl_guru" required>
        </div>
        <div class="mb-3">
            <label for="jk_guru">Jenis kelamin</label><span id="required" class="required">*</span>
            <select name="jk_guru" id="jk_guru" class="form-control" required>
                <option value="Laki-Laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label><span id="required" class="required">*</span>
            <select name="jabatan" id="jabatan" class="form-control" required>
                <option value="Guru">Guru</option>
                <option value="Kepsek">Kepsek</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    const tglGuruInput = document.getElementById('tgl_guru');
    tglGuruInput.value = '2000-01-01';

    const numberInput = document.getElementById('nip');
    numberInput.addEventListener('input', function() {
        let value = this.value;
        value = value.replace(/[^0-9]/g, '');
        value = value.slice(0, 16);
        this.value = value;
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    
    const cities = [
        @foreach($cities as $city)
            {name: "{{ $city['city_name'] }}", type: "{{ $city['type'] }}", province: "{{ $city['province'] }}" },
        @endforeach
    ];

    const input = document.getElementById('tempat_guru');
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
});
</script>


@endsection