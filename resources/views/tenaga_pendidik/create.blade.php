@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Guru</h1>
    <form action="{{ route('tenaga_pendidik.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip" required>
        </div>
        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control" id="nama_guru" required>
        </div>
        <!-- Tambahkan input untuk tempat_lahir_guru, tgl_lahir_guru, jeniskelamin_guru, jabatan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
