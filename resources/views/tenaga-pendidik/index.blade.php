@extends('layouts.navbar')
@section('content')
@if(session()->has('success'))
    <script>
        alert("Data berhasil dihapus!"); // Ganti dengan pesan yang sesuai
    </script>
    @endif
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tenaga Pendidik</h1>
    <a href="{{ route('tenaga-pendidik.create') }}" class="btn btn-primary">Tambah Guru</a>
    <br><br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tenaga Pendidik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($tenagaPendidik as $tp)
                        <tr>
                            <td>{{ $tp->nip }}</td>
                            <td>{{ $tp->nama_guru }}</td>
                            <td>{{ $tp->tempat_guru }}</td>
                            <td>{{ $tp->tgl_guru }}</td>
                            <td>{{ $tp->jk_guru }}</td>
                            <td>{{ $tp->jabatan }}</td>
                            <td>
                                <a href="{{ route('tenaga-pendidik.show', $tp->id_pendidik) }}">Lihat</a>
                                <a href="{{ route('tenaga-pendidik.edit', $tp->id_pendidik) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('tenaga-pendidik.destroy', $tp->id_pendidik) }}" method="POST" style="display:inline;">
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
        </div>
    </div>

</div>
@endsection