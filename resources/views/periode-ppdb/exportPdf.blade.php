<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil PPDB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-sm">

<div class="max-w-4xl mx-auto">

    <!-- Kop Surat -->
    <div class="border-b-2 border-black pb-4 mb-6">
        <div class="flex items-center">

            <div class="w-28">
                <img src="{{ asset('img/maittaqu.png') }}" class="w-24">
            </div>

            <div class="text-center flex-1">
                <h2 class="text-lg font-semibold">YAYASAN PENDIDIKAN ITTAQU SURABAYA</h2>
                <h1 class="text-xl font-bold uppercase">MADRASAH ALIYAH ITTAQU</h1>
                <p>“Terakreditasi B”</p>
                <p>NSM : 131 235 780 012</p>
                <p class="text-xs mt-1">
                    Jl. Menanggal IV No.31-F Telp. (031) 8275887 Gayungan <br>
                    SURABAYA 60234
                </p>
            </div>

        </div>
    </div>


    <!-- Tanggal -->
    <div class="text-right mb-4">
        Surabaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>


    <!-- Nomor Surat -->
    <div class="mb-6">
        <p>Nomor : 001/PPDB/MAI/{{ date('Y') }}</p>
        <p>Lampiran : -</p>
        <p>Perihal : Laporan Hasil PPDB</p>
    </div>


    <!-- Isi Surat -->
    <div class="mb-6 text-justify">

        <p class="indent-8 mb-3">
            Berdasarkan pelaksanaan kegiatan Penerimaan Peserta Didik Baru (PPDB)
            Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }} yang dilaksanakan mulai tanggal
            {{ \Carbon\Carbon::parse($periode->startDate)->translatedFormat('d F Y') }}
            sampai dengan
            {{ \Carbon\Carbon::parse($periode->endDate)->translatedFormat('d F Y') }},
            maka diperoleh data hasil pendaftaran sebagai berikut:
        </p>

        <div class="ml-8 space-y-1">

            <p>1. Total pendaftar sebanyak {{ $totalPendaftar }} siswa.</p>
            <p>2. Total pendaftar selesai verifikasi sebanyak {{ $totalSelesai }} siswa.</p>
            <p>3. Pendaftar dengan status menunggu verifikasi
                sebanyak {{ $totalPend }} siswa.</p>

            <p>4. Pendaftar dengan status perlu perbaikan formulir
                sebanyak {{ $totalRejec }}siswa.</p>

            <p>5. Pengguna yang  belum
                mengisi formulir sebanyak {{ $totalaccount }} siswa.</p>

            <p>6. Pendaftar berjenis kelamin Laki-Laki
                sebanyak {{ $genL }}siswa.</p>

            <p>7. Pendaftar berjenis kelamin Perempuan
                sebanyak {{ $genP }} siswa.</p>

            <p>8. Pendaftar yang memiliki Kartu Indonesia Pintar (KIP)
                sebanyak {{ $kip }} siswa.</p>

            <p>9. Pendaftar yang tidak memiliki KIP
                sebanyak {{ $nokip }} siswa.</p>
            <!-- <p>10. Pendaftar dengan domisili terbanyak adalah {{ $domisiliTerbanyak->keys()->first() }}
                sebanyak {{ $domisiliTerbanyak->first() }} siswa.</p>
            <p>11. Pendaftar dengan asal sekolah terbanyak adalah {{ $sekolahTerbanyak->keys()->first() }}
                sebanyak {{ $sekolahTerbanyak->first() }} siswa.</p> -->

        </div>

        <p class="indent-8 mt-4">
            Demikian laporan hasil pelaksanaan PPDB ini disampaikan
            sebagai bahan informasi dan evaluasi pelaksanaan kegiatan
            penerimaan peserta didik baru pada tahun ajaran ini.
            Atas perhatian dan kerjasamanya kami ucapkan terima kasih.
        </p>

    </div>


    <!-- Tanda Tangan -->
    <div class="text-center mt-12">

        <p>Hormat kami,</p>
        <p>Kepala Sekolah MA ITTAQU SURABAYA</p>

        <div class="mt-16 font-semibold">
            {{ $kepsek->name }}
        </div>

        <p>NIP : {{ $kepsek->nip ?? '198007092001011107' }}</p>

    </div>

</div>

</body>
</html>