@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Tenaga Pendidik</h1>
    <a href="{{ route('tenaga_pendidik.create') }}" class="btn btn-primary">Tambah Guru</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenaga_pendidik as $guru)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->nama_guru }}</td>
                <td>{{ $guru->tempat_guru }}</td>
                <td>{{ $guru->tgl_guru }}</td>
                <td>{{ $guru->jk_guru }}</td>
                <td>{{ $guru->jabatan }}</td>
                <td>
                    <a href="{{ route('tenaga_pendidik.edit', $guru->id_pendidik) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tenaga_pendidik.destroy', $guru->id_pendidik) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection