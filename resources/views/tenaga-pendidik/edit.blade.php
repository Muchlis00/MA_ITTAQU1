<h1>Edit Tenaga Pendidik</h1>

@if(session()->has('success'))
<p>sukses</p>
@endif

<form action="{{ route('tenaga-pendidik.update', $tenagaPendidik->id_pendidik) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="nip">NIP:</label>
        <input type="text" name="nip" id="nip" value="{{ $tenagaPendidik->nip }}" required>
    </div>

    <div>
        <label for="nama_guru">Nama:</label>
        <input type="text" name="nama_guru" id="nama_guru" value="{{ $tenagaPendidik->nama_guru }}" required>
    </div>

    <div>
        <label for="tempat_guru">Tempat Lahir :</label>
        <input type="text" name="tempat_guru" id="tempat_guru" value="{{ $tenagaPendidik->tempat_guru }}" required>
    </div>

    <div>
        <label for="tgl_guru" class="form-label">Tanggal Lahir Guru</label>
        <input type="date" name="tgl_guru" id="tgl_guru" value="{{ $tenagaPendidik->tgl_guru }}" required>
    </div>


    <div>
        <label for="jk_guru">Jenis Kelamin:</label>
        <select name="jk_guru" id="jk_guru" required>
            <option value="Laki-Laki" {{ $tenagaPendidik->jk_guru == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $tenagaPendidik->jk_guru == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div>
        <label for="jabatan">Jabatan :</label>
        <select name="jabatan" id="jabatan" required>
            <option value="Guru" {{ $tenagaPendidik->jabatan == 'Guru' ? 'selected' : '' }}>Guru</option>
            <option value="Bendahara" {{ $tenagaPendidik->jabatan == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
            <option value="Kepsek" {{ $tenagaPendidik->jabatan == 'Kepsek' ? 'selected' : '' }}>Kepsek</option>
        </select>
    </div>




    <button type="submit">Simpan Perubahan</button>
</form>

<a href="{{ route('tenaga-pendidik.index') }}">Kembali ke Daftar</a>