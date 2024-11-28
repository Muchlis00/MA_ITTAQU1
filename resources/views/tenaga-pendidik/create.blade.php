
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
            <label for="jk_guru" class="form-label">jk Guru</label>
            <input type="text" name="jk_guru" class="form-control" id="jk_guru" required>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">jabatan Guru</label>
            <input type="text" name="jabatan" class="form-control" id="jabatan" required>
        </div>
        <!-- Tambahkan input untuk tempat_lahir_guru, tgl_lahir_guru, jeniskelamin_guru, jabatan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

