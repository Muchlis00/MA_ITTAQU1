<!DOCTYPE html>
<html>
<head>
	<title>data tenaga pendidik</title>
</head>
<body>
 
	<h2>www.malasngoding.com</h2>
	<h3>Data Pegawai</h3>
 
	<a href="/tenaga_pendidik/create"> + Tambah Pegawai Baru</a>
	
	<br/>
	<br/>
 
	<table border="1">
		<tr>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Umur</th>
			<th>Alamat</th>
			<th>Opsi</th>
		</tr>
		    @foreach($tenagaPendidik as $guru)
            <tr>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->nama_guru }}</td>
                <td>{{ $guru->tempat_guru }}</td>
                <td>{{ $guru->tgl_guru }}</td>
                <td>{{ $guru->jk_guru }}</td>
                <td>{{ $guru->jabatan }}</td>
			<td>
				<a href="/pegawai/edit/{{ $guru->id_pendidik }}">Edit</a>
				|
				<a href="/pegawai/hapus/{{ $guru->id_pendidik }}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>
 
 
</body>
</html>