
@extends('layouts.navbar')
@section('content')
<style>
.required {
    color: red;
}
</style>
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        Sukses
    </div>
    @endif

    <h1 class="mb-4">Edit Tenaga Pendidik</h1>

    <form action="{{ route('tenaga-pendidik.update', $tenagaPendidik->id_pendidik) }}" method="POST">
        @csrf
        @method('PUT')
<div class="mb-4">
    <p class="text-sm text-gray-600">
        <span class="required">*</span>
        Menandakan kolom yang wajib diisi.
    </p>
</div>
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label><span class="required">*</span>
            <input type="text" name="nip" class="form-control" id="nip" value="{{ $tenagaPendidik->nip }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Guru</label><span class="required">*</span>
            <input type="text" name="nama_guru" class="form-control" id="nama_guru" value="{{ $tenagaPendidik->nama_guru }}" required>
        </div>


        <div class="mb-3">
            
            <label for="tempat_guru">Tempat Lahir</label><span class="required">*</span>
            <input
                type="text"
                id="tempat_guru"
                name="tempat_guru"
                class="form-control"
                placeholder="Ketik nama kota"
                value="{{ $tenagaPendidik->tempat_guru }}"
                autocomplete="off">
            <div id="city-suggestions" class="suggestions"></div>
        </div>

        <div class="mb-3">
            <label for="tgl_guru" class="form-label">Tanggal Lahir Guru</label><span class="required">*</span>
            <input type="date" name="tgl_guru" class="form-control" id="tgl_guru" value="{{ $tenagaPendidik->tgl_guru }}" required>
        </div>

        <div class="mb-3">
            <label for="jk_guru" class="form-label">Jenis Kelamin Guru</label><span class="required">*</span>
            <select name="jk_guru" id="jk_guru" class="form-control" required>
                <option value="Laki-Laki" {{ $tenagaPendidik->jk_guru == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $tenagaPendidik->jk_guru == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan Guru</label><span class="required">*</span>
            <select name="jabatan" id="jabatan" class="form-control" required>
                <option value="Guru" {{ $tenagaPendidik->jabatan == 'Guru' ? 'selected' : '' }}>Guru</option>
                <option value="Kepsek" {{ $tenagaPendidik->jabatan == 'Kepsek' ? 'selected' : '' }}>Kepsek</option>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('tenaga-pendidik.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
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