<!DOCTYPE html>
<html>
<head>
	<title>data tenaga pendidik</title>
</head>
<body>
 
	<h2>www.malasngoding.com</h2>
	<h3>Data Pegawai</h3>
 
	<a href="/tenagapendidik/create"> + Tambah Pegawai Baru</a>
	
	<br/>
	<br/>
 
	<table border="1">
		<tr>
			<th>ID Pendidik</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Tempat</th>
			<th>tanggal</th>
			<th>jeniskelamin</th>
			<th>jabatan</th>
			<th>Opsi</th>
		</tr>
		    @foreach($tenagaPendidik as $k)
            <tr>
				<td>{{ $k->id_pendidik }}</td>
                <td>{{ $k->nip }}</td>
                <td>{{ $k->nama_guru }}</td>
                <td>{{ $k->tempat_guru }}</td>
                <td>{{ $k->tgl_guru }}</td>
                <td>{{ $k->jk_guru }}</td>
                <td>{{ $k->jabatan }}</td>
			<td>
				<a href="{{ route('tenagapendidik.show', $k->id_pendidik) }}" class="btn btn-warning">show</a>
			<a href="{{ route('tenagapendidik.edit', $k->id_pendidik) }}" class="btn btn-warning">Edit</a>

				<!-- <form action="{{ route('tenagapendidik.edit', $k->id_pendidik) }}" method="GET" style="display:inline;"> -->
					@csrf
					<!-- @method('PUT') -->
					<button type="submit" class="btn btn-danger">Edit</button>
				</form>

				<!-- <a href="/tenagapendidik/show/{{ $k->id_pendidik }}">Edit</a> -->
				|
				<!-- <a href="/tenagapendidik/destroy/{{ $k->id_pendidik }}">Hapus</a> -->
				<form action="{{ route('tenagapendidik.destroy', $k->id_pendidik) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
 
 
</body>
</html>