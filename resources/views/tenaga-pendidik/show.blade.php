<h1>Detail Tenaga Pendidik</h1>

<p>Nama: {{ $tenagaPendidik->nama_guru }}</p>
<p>NIP: {{ $tenagaPendidik->nip }}</p>
<p>Tempat: {{ $tenagaPendidik->tempat_guru }}</p>
<p>tanggal Lahir: {{$tenagaPendidik->tgl_guru}}</p>
<p>Jenis Kelamin: {{ $tenagaPendidik->jk_guru }}</p>
<p>Jabatan: {{ $tenagaPendidik->jabatan }}</p>

<a href="{{ route('tenaga-pendidik.index') }}">Kembali ke Daftar</a>