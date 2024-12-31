@extends('layouts.navbar')
@section('content')
<div class="container">
    <h1 class="mb-4">Detail Tenaga Pendidik</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">NIP</th>
                    <td>{{ $tenagaPendidik->nip }}</td>
                </tr>
                <tr>
                    <th>Nama Guru</th>
                    <td>{{ $tenagaPendidik->nama_guru }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $tenagaPendidik->tempat_guru }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $tenagaPendidik->tgl_guru }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $tenagaPendidik->jk_guru }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $tenagaPendidik->jabatan }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('tenaga-pendidik.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
</div>
@endsection