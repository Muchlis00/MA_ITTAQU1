<!DOCTYPE html>
<html>
<head>
	<title>data tenaga pendidik</title>
</head>
<body>
    

<div class="container">
    <h1>Data Tenaga Pendidik</h1>
    <a href="{{ route('tenaga-pendidik.create') }}" class="btn btn-primary">Tambah Guru</a>
    <table class="table table-bordered mt-3">
        <thead>
        <table border="1">
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
</body>