<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Pdf</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body>
    <!-- Kop Surat Container -->
    <div class="max-w-4xl mx-auto border-b-2 border-black pb-4 mb-8">
        <!-- Header Kop Surat -->
        <div class="flex items-center justify-between mb-2">
            <!-- Logo Kiri -->
            <div class="w-32 h-32 flex items-center justify-center">
                <img src="{{ asset('img/maittaqu.png') }}" alt="Ma ittaqu" class="max-w-full max-h-full object-contain">
            </div>
            
            <!-- Informasi Perusahaan -->
            <div class="text-center flex-1 px-4">
                <h2 class="text-lg md:text-xl font-semibold">YAYASAN PENDIDIKAN ITTAQU SURABAYA</h2>
                <h1 class="text-xl md:text-2xl font-bold uppercase">MADRASAH ALIYAH ITTAQU</h1>
                <h2 class="text-lg md:text-xl font-semibold">“ Terakreditasi B “</h2>
                <h2 class="text-lg md:text-xl font-semibold">NSM : 131 235 780 012</h2>
                <div class="text-sm md:text-base mt-1">
                    <p>Jl. Menanggal IV No. 31-F Telp. (031) 8275887 Gayungan</p>
                    <p>S U R A B A Y A 60234</p>
                </div>
            </div>
        </div>
        <div class="border-t-2 border-black mt-2"></div>
    </div>
    
    <!-- Konten Surat -->
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-4">
            <p class="text-right">Surabaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

        </div>
        
        <div class="mb-4">
            <p>Nomor: 001/DP/VI/ {{ \Carbon\Carbon::now()->translatedFormat('Y') }} </p>
            <p>Lampiran: -</p>
            <p>Perihal: Hasil PPDB Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }} </p>
            
        </div>
    
        
        <div class="mb-8">
            <p>Berhubung dilaksanakannya kegiatan PPDB TAHUN AJARAN {{ date('Y') }}/{{ date('Y')+1 }} pada Tanggal {{ date('d/m/Y', strtotime($periode->startDate)) }}
                dan berakhir pada Tanggal {{ date('d/m/Y', strtotime($periode->endDate)) }}. dengan rincian sebagai berikut :
        </p>
        <br>
            <p class="text-justify indent-8">
                1. Total Pendaftar berjumlah  {{ $totalPendaftar }} siswa           </p>
                <p class="text-justify indent-8">
                2. Total Pendaftar yang tidak melanjutkan perbaikan berjumlah {{ $totalRejec }} siswa           </p>
            <p class="text-justify indent-8">
                3. Total Pendaftar yang menunggu verifikasi berjumlah {{ $totalPend }} siswa           </p>
                <p class="text-justify indent-8">
                4. Total Pendaftar yang hanya daftar akun berjumlah  {{ $totalaccount }} siswa           </p>
                <p class="text-justify indent-8">
                5. Total Pendaftar memiliki KIP berjumlah {{ $kip }}  siswa         </p>
                <p class="text-justify indent-8">
                6. Total Pendaftar yang tidak memiliki KIP berjumlah {{ $nokip }} siswa           </p>
                <p class="text-justify indent-8">
                7. Total Pendaftar Laki-Laki {{ $genL }} siswa          </p>
                <p class="text-justify indent-8">
                8. Total Pendaftar Perempuan {{ $genP }} siswa          </p>

                <br>
            <p class="mb-8">
                Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
            </p>
        </div>
        
        <div class="text-center">
            <p class="">Hormat kami,</p>
            <p class="mb-12">Kepala Sekolah MA ITTAQU SURABAYA</p>

            <p class="font-semibold">{{ $kepsek->name }}</p>
            <p>NIP : {{ $kepsek->nip ?? '15468986548245' }}</p>
        </div>
    </div>
</body>
</html>