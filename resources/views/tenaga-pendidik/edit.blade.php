@extends('layouts.navbar')
@section('content')
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

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip" value="{{ $tenagaPendidik->nip }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control" id="nama_guru" value="{{ $tenagaPendidik->nama_guru }}" required>
        </div>

        <div class="mb-3">
            <label for="tempat_guru" class="form-label">Tempat Lahir Guru</label>
            <input type="text" name="tempat_guru" class="form-control" id="tempat_guru" value="{{ $tenagaPendidik->tempat_guru }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_guru" class="form-label">Tanggal Lahir Guru</label>
            <input type="date" name="tgl_guru" class="form-control" id="tgl_guru" value="{{ $tenagaPendidik->tgl_guru }}" required>
        </div>

        <div class="mb-3">
            <label for="jk_guru" class="form-label">Jenis Kelamin Guru</label>
            <select name="jk_guru" id="jk_guru" class="form-select" required>
                <option value="Laki-Laki" {{ $tenagaPendidik->jk_guru == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $tenagaPendidik->jk_guru == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan Guru</label>
            <select name="jabatan" id="jabatan" class="form-select" required>
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
@endsection