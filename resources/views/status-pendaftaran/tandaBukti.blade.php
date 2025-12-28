<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bukti Di Terima</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black antialiased">

  <div class="max-w-4xl mx-auto border-b-2 border-black pb-4 mb-8">
    <div class="flex items-center justify-between mb-2">
      
      <div class="w-32 h-32 flex items-center justify-center">
        <img src="{{ asset('img/maittaqu.png') }}" alt="Logo MA ITTAQU" class="max-w-full max-h-full object-contain" />
      </div>

      <div class="flex-1 text-center px-4">
        <h2 class="text-lg md:text-xl font-semibold">YAYASAN PENDIDIKAN ITTAQU SURABAYA</h2>
        <h1 class="text-xl md:text-2xl font-bold uppercase">MADRASAH ALIYAH ITTAQU</h1>
        <h2 class="text-lg md:text-xl font-semibold">" Terakreditasi B "</h2>
        <h2 class="text-lg md:text-xl font-semibold">NSM : 131 235 780 012</h2>
        <div class="text-sm md:text-base mt-1 leading-tight">
          <p>Jl. Menanggal IV No. 31-F Telp. (031) 8275887 Gayungan</p>
          <p>S U R A B A Y A 60234</p>
        </div>
      </div>

    </div>

    <div class="border-t-2 border-black mt-2"></div>
  </div>

  <!-- Isi Surat -->
  <div class="max-w-4xl mx-auto px-4">
    
    <!-- Tanggal -->
    <div class="mb-6 text-right">
      <p>Surabaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>

    <!-- Nomor dan Perihal -->
    <div class="mb-6 space-y-2">
      <div class="flex">
        <p class="w-24">Nomor</p>
        <p>: 001/DP/VI/{{ \Carbon\Carbon::now()->translatedFormat('Y') }}</p>
      </div>
      <div class="flex">
        <p class="w-24">Perihal</p>
        <p>: Hasil Penerimaan Peserta Didik Baru {{ $currentPeriode->name }}</p>
      </div>
    </div>
    <br>
    <!-- Identitas Penandatangan -->
    <div class="mb-8 space-y-3">
      <p class="text-justify">Yang bertanda tangan di bawah ini:</p>
      <div class="flex">
        <p class="w-24">Nama</p>
        <p>: {{ $kepsek->name }}</p>
      </div>
      <div class="flex">
        <p class="w-24">Jabatan</p>
        <p>: Kepala MA ITTAQU SURABAYA</p>
      </div>
    </div>

    <div class="mb-8 space-y-3">
      <p class="text-justify">Menerangkan bahwa:</p>
      <div class="flex">
        <p class="w-24">Nama</p>
        <p>: {{ $user->name }}</p>
      </div>
      <div class="flex">
        <p class="w-24">NISN</p>
        <p>: {{ $currentDataDiriPendaftar->nisn }}</p>
      </div>
      <div class="flex">
        <p class="w-24">Tempat, Tanggal Lahir</p>
        <p>: {{ $currentDataDiriPendaftar->place_of_birth }}, {{ $currentDataDiriPendaftar->date_of_birth }}</p>
      </div>
      <div class="flex">
        <p class="w-24">Asal Sekolah</p>
        <p>: {{ $currentDataDiriPendaftar->previous_school_name }}</p>
      </div>
      <br>
      <div class="mx-auto mt-10 mb-6 w-full max-w-md border-2 border-black rounded-md p-4 bg-white text-center">
        <h2 class="text-xl font-semibold">DITERIMA DI MA ITTAQU SURABAYA</h2>
      </div>

      <p class="text-justify indent-8 mt-4">
        Surat ini sebagai bukti bahwa yang bersangkutan telah menyelesaikan proses pendaftaran secara lengkap.
        Demikian surat ini kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.
      </p>
    </div>
    <br>
    <br>

    <div class="text-right mt-16">
      <div class="mb-2">
        <p>Surabaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
      </div>
      <div class="mb-8">
        <p>Kepala MA ITTAQU SURABAYA,</p>
      </div>
      <div class="inline-block text-center">
        <p class="font-semibold mb-1">{{ $kepsek->name }}</p>
        <p>NIP. {{ $kepsek->nip ?? '15468986548245' }}</p>
      </div>
    </div>

  </div>

</body>
</html>