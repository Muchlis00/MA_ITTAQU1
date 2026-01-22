<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB MA ITTAQU - Pendaftaran Peserta Didik Baru</title>
    <meta name="description" content="Pendaftaran Peserta Didik Baru Madrasah Aliyah ITTAQU - Pendidikan Islam Berkualitas">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Bagian Kiri: Logo dan Status Pendaftaran -->
            <div class="flex-1 flex items-center">
                <img src="{{ asset('img/maittaqu.png') }}" alt="Logo MA ITTAQU" class="h-10 mr-3">
                <div class="max-w-xs">
                    @if($isPeriodActive)
                        <div class="bg-green-50 border-l-4 border-green-600 text-green-800 p-2 rounded-lg">
                            <p class="font-bold text-sm">Pendaftaran {{ $activePeriod->name }} Dibuka!</p>
                            <p class="text-xs">
                                <i class="far fa-calendar-alt mr-1"></i> 
                                {{ \Carbon\Carbon::parse($activePeriod->startDate)->translatedFormat('d F Y') }} - 
                                {{ \Carbon\Carbon::parse($activePeriod->endDate)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 p-2 rounded-lg">
                            <p class="font-bold text-sm">Pendaftaran Belum diBuka </p>
                            @php
                                $nextPeriod = \App\Models\PeriodePPDB::where('startDate', '>', now())
                                                    ->orderBy('startDate', 'asc')
                                                    ->first();
                            @endphp
                            @if($nextPeriod)
                            <p class="text-xs">
                                <i class="far fa-clock mr-1"></i> 
                                Dibuka: {{ \Carbon\Carbon::parse($nextPeriod->startDate)->translatedFormat('d F Y') }}
                            </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bagian Tengah: Countdown Timer -->
            <div class="flex-1">
                @if($isPeriodActive)
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-center text-blue-800 font-medium text-sm mb-1">
                            <i class="far fa-clock mr-1"></i> Waktu tersisa:
                        </p>
                        
                        <div id="countdown" class="flex items-center justify-center gap-1 md:gap-2">
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-700 text-white text-sm md:text-base font-bold px-2 py-1 rounded w-12 md:w-14 text-center">
                                    <span id="countdown-days">22</span>
                                </div>
                                <span class="text-xs text-blue-800 mt-0.5">Hari</span>
                            </div>
                            <div class="text-blue-700 font-bold text-sm h-full flex items-center">:</div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-700 text-white text-sm md:text-base font-bold px-2 py-1 rounded w-12 md:w-14 text-center">
                                    <span id="countdown-hours">11</span>
                                </div>
                                <span class="text-xs text-blue-800 mt-0.5">Jam</span>
                            </div>
                            <div class="text-blue-700 font-bold text-sm h-full flex items-center">:</div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-700 text-white text-sm md:text-base font-bold px-2 py-1 rounded w-12 md:w-14 text-center">
                                    <span id="countdown-minutes">19</span>
                                </div>
                                <span class="text-xs text-blue-800 mt-0.5">Menit</span>
                            </div>
                            <div class="text-blue-700 font-bold text-sm h-full flex items-center">:</div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-700 text-white text-sm md:text-base font-bold px-2 py-1 rounded w-12 md:w-14 text-center">
                                    <span id="countdown-seconds">54</span>
                                </div>
                                <span class="text-xs text-blue-800 mt-0.5">Detik</span>
                            </div>
                        </div>
                    </div>

                    <script>
                        const endDate = new Date("{{ $activePeriod->endDate }}").getTime();
                        
                        const timer = setInterval(function() {
                            const now = new Date().getTime();
                            const distance = endDate - now;
                            
                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            document.getElementById("countdown-days").textContent = days.toString().padStart(2, '0');
                            document.getElementById("countdown-hours").textContent = hours.toString().padStart(2, '0');
                            document.getElementById("countdown-minutes").textContent = minutes.toString().padStart(2, '0');
                            document.getElementById("countdown-seconds").textContent = seconds.toString().padStart(2, '0');
                            
                            if (distance < (1000 * 60 * 60 * 24)) {
                                document.querySelectorAll('#countdown > div > div').forEach(el => {
                                    el.classList.remove('bg-blue-700');
                                    el.classList.add('bg-red-600');
                                });
                            }
                            
                            if (distance < 0) {
                                clearInterval(timer);
                                document.getElementById("countdown").innerHTML = `
                                    <div class="bg-red-600 text-white px-3 py-2 rounded text-sm font-bold">
                                        <i class="fas fa-exclamation-circle mr-1"></i> PENDAFTARAN DITUTUP
                                    </div>
                                `;
                                location.reload();
                            }
                        }, 1000);
                    </script>
                @endif
            </div>

            <!-- Bagian Kanan: Tombol Login dan Daftar -->
            <div class="flex-1 flex justify-end">
                <nav class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg text-sm transition duration-300 shadow-sm">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    @if($isPeriodActive)
                        <a href="{{ route('register') }}" class="text-white bg-green-600 hover:bg-green-700 px-3 py-2 rounded-lg text-sm transition duration-300 shadow-sm">
                            <i class="fas fa-user-plus mr-1"></i> Daftar
                        </a>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- SLIDER CONTAINER -->
        <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-2 mb-8">
            <!-- SLIDES -->
            <div id="slides" class="flex transition-transform duration-500 ease-in-out">
                
                <!-- ================= SLIDE 1: WELCOME & KEUNGGULAN ================= -->
                <section class="min-w-full px-4 py-6">
                    <!-- Hero Section -->
                    <div class="text-center mb-10">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                            Selamat Datang di PPDB<br>MA ITTAQU
                        </h1>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                            Bergabunglah dengan pendidikan berkualitas yang mengintegrasikan ilmu pengetahuan 
                            dengan nilai-nilai Islami berdasarkan Al-Qur'an dan Sunnah.
                        </p>
                    </div>

                    <!-- Why Choose Us -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6">
                                <span class="border-b-2 border-blue-600 pb-2">Keunggulan MA ITTAQU</span>
                            </h2>
                            <ul class="space-y-4">
                                <li class="flex items-start bg-gray-50 p-4 rounded-lg hover:shadow-md transition duration-300">
                                    <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                                        <i class="fas fa-quran text-sm"></i>
                                    </span>
                                    <span class="text-gray-700">Berlandaskan tuntunan Al-Qur'an dan Sunnah dengan pemahaman Ahlusunnah Wal Jama'ah</span>
                                </li>
                                <li class="flex items-start bg-gray-50 p-4 rounded-lg hover:shadow-md transition duration-300">
                                    <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                                        <i class="fas fa-hands-helping text-sm"></i>
                                    </span>
                                    <span class="text-gray-700">Pendidikan akhlaq mulia mengikuti contoh Rasulullah shallallahu 'alaihi wasallam</span>
                                </li>
                                <li class="flex items-start bg-gray-50 p-4 rounded-lg hover:shadow-md transition duration-300">
                                    <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                                        <i class="fas fa-globe-asia text-sm"></i>
                                    </span>
                                    <span class="text-gray-700">Membentuk generasi muslim yang rahmatan lil'alamin</span>
                                </li>
                                <li class="flex items-start bg-gray-50 p-4 rounded-lg hover:shadow-md transition duration-300">
                                    <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                                        <i class="fas fa-user-shield text-sm"></i>
                                    </span>
                                    <span class="text-gray-700">Pengembangan karakter: jujur, disiplin, tanggung jawab, dan kerjasama</span>
                                </li>
                                <li class="flex items-start bg-gray-50 p-4 rounded-lg hover:shadow-md transition duration-300">
                                    <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                                        <i class="fas fa-brain text-sm"></i>
                                    </span>
                                    <span class="text-gray-700">Pembelajaran yang menstimulus berpikir kritis, kreatif dan inovatif</span>
                                </li>
                            </ul>
                        </div>
                        <div class="flex justify-center">
                            <div class="relative rounded-xl overflow-hidden shadow-lg max-w-md">
                                <img src="{{ asset('img/maittaqu.png') }}" alt="MA ITTAQU" class="w-full h-auto object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end">
                                    <div class="p-6 text-white">
                                        <h3 class="text-xl font-bold">MA ITTAAQU</h3>
                                        <p class="text-sm">Fasilitas lengkap untuk mendukung proses belajar mengajar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ================= SLIDE 2: PERSYARATAN PENDAFTARAN ================= -->
                <section class="min-w-full px-4 py-6">
                    <!-- Header tetap ditampilkan -->
                    <div class="bg-white rounded-xl overflow-hidden h-full flex flex-col">
                        <!-- HEADER SAMA SEPERTI SLIDE 4 -->
                        <div class="bg-blue-700 text-white p-6">
                            <h2 class="text-2xl font-bold text-center">
                                <i class="fas fa-file-contract mr-2"></i> Persyaratan Pendaftaran
                            </h2>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 flex-grow overflow-y-auto">
                            @if($isPeriodActive)
                            <div class="prose max-w-4xl mx-auto">
                                <div class="bg-blue-50 p-6 rounded-lg mb-6 border border-blue-100">
                                    <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                                        <i class="fas fa-file-alt mr-2"></i> Persyaratan Umum
                                    </h3>
                                    {!! $agreementContent !!}
                                </div>
                            </div>
                            @else
                            <!-- Tampilkan pesan jika periode tidak aktif -->
                            <div class="h-full flex items-center justify-center">
                                <div class="text-center py-8">
                                    <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500 text-lg">Pendaftaran belum dibuka</p>
                                    @php
                                        $nextPeriod = \App\Models\PeriodePPDB::where('startDate', '>', now())
                                            ->orderBy('startDate', 'asc')
                                            ->first();
                                    @endphp
                                    @if($nextPeriod)
                                    <p class="text-gray-600 mt-2 text-sm">
                                        <i class="far fa-clock mr-1"></i> 
                                        Pendaftaran akan dibuka: {{ \Carbon\Carbon::parse($nextPeriod->startDate)->translatedFormat('d F Y') }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- ================= SLIDE 3: INFORMASI PEMBAYARAN ================= -->
                <section class="min-w-full px-4 py-6">
                    <!-- Header tetap ditampilkan -->
                    <div class="bg-white rounded-xl overflow-hidden h-full flex flex-col">
                        <!-- HEADER SAMA SEPERTI SLIDE 4 -->
                        <div class="bg-blue-700 text-white p-6">
                            <h2 class="text-2xl font-bold text-center">
                                <i class="fas fa-file-contract mr-2"></i> Rincian Pembayaran
                            </h2>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 flex-grow overflow-y-auto">
                            @if($isPeriodActive)
                            <div class="prose max-w-4xl mx-auto">
                                <div class="bg-green-50 p-6 rounded-lg mb-6 border border-green-100">
                                    <h3 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2"></i> Informasi Pembayaran
                                    </h3>
                                    {!! $informasiPembayaran !!}
                                </div>
                            </div>
                            @else
                            <!-- Tampilkan pesan jika periode tidak aktif -->
                            <div class="h-full flex items-center justify-center">
                                <div class="text-center py-8">
                                    <i class="fas fa-lock text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500 text-lg">Informasi pembayaran belum tersedia</p>
                                    <p class="text-gray-600 mt-2 text-sm">
                                        Informasi pembayaran akan tersedia saat pendaftaran dibuka
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- ================= SLIDE 4: JADWAL ORIENTASI ================= -->
                <section class="min-w-full px-4 py-6">
                    <!-- Header tetap ditampilkan -->
                    <div class="bg-white rounded-xl overflow-hidden h-full flex flex-col">
                        <div class="bg-blue-700 text-white p-6">
                            <h2 class="text-2xl font-bold text-center">
                                <i class="fas fa-file-contract mr-2"></i> Matsama / Orientasi 
                            </h2>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 flex-grow overflow-y-auto">
                            @if($orientasi->count() > 0)
                                <div class="overflow-x-auto rounded-lg border border-gray-200">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Hari/Tanggal</th>
                                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Waktu</th>
                                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kegiatan</th>
                                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach($orientasi as $item)
                                            <tr class="hover:bg-gray-50 transition duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ \Carbon\Carbon::parse($item->datetime_start)->translatedFormat('l') }}<br>
                                                        <span class="text-gray-600">{{ \Carbon\Carbon::parse($item->datetime_start)->translatedFormat('d F Y') }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ \Carbon\Carbon::parse($item->datetime_start)->translatedFormat('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($item->datetime_end)->translatedFormat('H:i') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">{{ $item->kegiatan }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">{{ $item->keterangan ?? '-' }}</div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="h-full flex items-center justify-center">
                                    <div class="text-center py-8 text-gray-500">
                                        <i class="fas fa-info-circle text-4xl mb-4"></i>
                                        <p class="text-lg">Jadwal orientasi belum tersedia</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <!-- BUTTON NAVIGATION & INDICATORS -->
        <div class="flex flex-col md:flex-row justify-between items-center mt-8 space-y-4 md:space-y-0">
            <button onclick="prevSlide()"
                class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg transition duration-300 shadow-sm">
                <i class="fas fa-chevron-left mr-2"></i> Sebelumnya
            </button>

            <div class="flex items-center space-x-6">
                <!-- Slide Indicators -->
                <div class="flex space-x-2">
                    @for($i = 0; $i < 4; $i++)
                    <button onclick="goToSlide({{ $i }})"
                        class="w-3 h-3 rounded-full transition duration-300 {{ $i === 0 ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400' }}"
                        id="indicator-{{ $i }}">
                    </button>
                    @endfor
                </div>
                
                <!-- Slide Counter -->
                <span id="slide-counter" class="text-gray-700 font-medium bg-gray-100 px-4 py-2 rounded-lg">
                    Slide <span id="current-slide">1</span> dari 4
                </span>
            </div>

            <button onclick="nextSlide()"
                class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg transition duration-300 shadow-sm">
                Selanjutnya <i class="fas fa-chevron-right ml-2"></i>
            </button>
        </div>

        <!-- Tombol Daftar CTA (Jika periode aktif) -->
        @if($isPeriodActive)
        <div class="text-center mt-12">
            <a href="{{ route('register') }}" 
               class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold text-lg px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <i class="fas fa-user-plus mr-3 text-xl"></i> DAFTAR SEKARANG
            </a>
            <p class="text-gray-600 mt-3 text-sm">Kesempatan terbatas! Segera daftarkan diri Anda.</p>
        </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('img/maittaqu.png') }}" alt="Logo MA ITTAQU" class="h-8 mr-2">
                        <h3 class="text-xl font-bold">MA ITTAQU</h3>
                    </div>
                    <p class="text-gray-300 text-sm mb-4">
                        Madrasah Aliyah berbasis Al-Qur'an dan Sunnah dengan pemahaman Ahlus Sunnah wal Jama'ah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="https://www.youtube.com/@ypittaqusurabaya3563" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-youtube text-lg"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=+6285815061414&text=Assalamualaikum, Saya ingin bertanya" 
                           class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm flex items-center transition duration-300"><i class="fas fa-chevron-right mr-2 text-xs"></i> Beranda</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm flex items-center transition duration-300"><i class="fas fa-chevron-right mr-2 text-xs"></i> Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm flex items-center transition duration-300"><i class="fas fa-chevron-right mr-2 text-xs"></i> Galeri</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Kontak Kami</h4>
                    <ul class="space-y-3 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>Jl. Menanggal IV Gang Moris No 7 Gayungan Surabaya 60234</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-blue-400"></i>
                            <span>(+62) 823-3504-0234</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            <span>ypittaqu@gmail.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-blue-400"></i>
                            <span>Senin-Jumat: 08:00 - 16:00</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Informasi</h4>
                    <p class="text-gray-300 text-sm mb-4">
                        Dapatkan informasi terbaru tentang PPDB dan kegiatan MA ITTAQU langsung ke email Anda.
                    </p>
                    <form class="flex" id="newsletter-form">
                        <input type="email" placeholder="Alamat Email" 
                               class="px-3 py-2 text-sm text-gray-800 rounded-l-lg focus:outline-none w-full focus:ring-2 focus:ring-blue-500"
                               required>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r-lg text-sm transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} MA ITTAQU. Semua Hak Dilindungi.</p>
                <div class="mt-2 flex flex-wrap justify-center gap-4">
                    <a href="#" class="hover:text-white transition duration-300">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition duration-300">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white transition duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        let currentSlide = 0;
        const slides = document.getElementById('slides');
        const totalSlides = slides.children.length;
        const counter = document.getElementById('current-slide');

        function updateSlide() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
            counter.textContent = currentSlide + 1;
            
            // Update indicators
            for (let i = 0; i < totalSlides; i++) {
                const indicator = document.getElementById(`indicator-${i}`);
                if (i === currentSlide) {
                    indicator.classList.remove('bg-gray-300');
                    indicator.classList.add('bg-blue-600');
                } else {
                    indicator.classList.remove('bg-blue-600');
                    indicator.classList.add('bg-gray-300');
                }
            }
        }

        function nextSlide() {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlide();
            } else {
                // Loop kembali ke slide pertama
                currentSlide = 0;
                updateSlide();
            }
        }

        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlide();
            } else {
                // Loop ke slide terakhir
                currentSlide = totalSlides - 1;
                updateSlide();
            }
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlide();
        }

        // Auto slide setiap 10 detik
        setInterval(nextSlide, 10000);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') prevSlide();
            if (e.key === 'ArrowRight') nextSlide();
        });

        // Newsletter form submission
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            alert(`Terima kasih! Email ${email} telah berhasil didaftarkan untuk newsletter.`);
            this.reset();
        });
    </script>
</body>
</html>