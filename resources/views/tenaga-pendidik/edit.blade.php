<h1>Edit Tenaga Pendidik</h1>

<form action="{{ route('tenaga-pendidik.update', $tenagaPendidik->id_pendidik) }}" method="POST">
    @csrf
    @method('PUT') 

    <div>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="{{ $tenagaPendidik->nama_guru }}" required>
    </div>

    <div>
        <label for="nip">NIP:</label>
        <input type="text" name="nip" id="nip" value="{{ $tenagaPendidik->nip }}" required>
    </div>

    <div>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="L" {{ $tenagaPendidik->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $tenagaPendidik->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div>
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required>{{ $tenagaPendidik->alamat }}</textarea>
    </div>

    <div>
        <label for="mata_pelajaran">Mata Pelajaran:</label>
        <input type="text" name="mata_pelajaran" id="mata_pelajaran" value="{{ $tenagaPendidik->mata_pelajaran }}" required>
    </div>

    <button type="submit">Simpan Perubahan</button>
</form>

<a href="{{ route('tenaga-pendidik.index') }}">Kembali ke Daftar</a>