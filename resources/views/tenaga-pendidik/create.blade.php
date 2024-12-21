<div class="container">
    @if(session()->has('success'))
    <p>sukses</p>
    @endif
    <h1>Tambah Guru</h1>
    <form action="{{ route('tenaga-pendidik.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip" required>
        </div>
        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control" id="nama_guru" required>
        </div>
        <div class="mb-3">
            <label for="tempat_guru" class="form-label">Tempat Lahir Guru</label>
            <input type="text" name="tempat_guru" class="form-control" id="tempat_guru" required>
        </div>
        <div class="mb-3">
            <label for="tgl_guru" class="form-label">Tanggal Lahir Guru</label>
            <input type="date" name="tgl_guru" class="form-control" id="tgl_guru" required>
        </div>
        <div class="mb-3">
            <label for="jk_guru">jk Guru</label>
            <select name="jk_guru" id="jk_guru" required>
                <option value="Laki-Laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">jabatan Guru</label>
            <select name="jabatan" id="jabatan" required>
            <option value="Guru">Guru</option>
            <option value="Bendahara">Bendahara</option>
            <option value="Kepsek">Kepsek</option>
        </select>
        </div>
        <!-- Tambahkan input untuk tempat_lahir_guru, tgl_lahir_guru, jeniskelamin_guru, jabatan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>