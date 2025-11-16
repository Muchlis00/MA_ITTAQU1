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
            <div class="flex items-center">
                <img src="{{ asset('img/maittaqu.png') }}" alt="Logo MA ITTAQU" class="h-10 mr-3">
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-blue-800">PPDB MA ITTAQU</h1>
                    <p class="text-xs text-gray-500">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
                </div>
            </div>
            <nav class="flex items-center space-x-3">
                <a href="{{ route('login') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg text-sm md:text-base transition duration-300 transform hover:scale-105 shadow-sm">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </a>
                @if($isPeriodActive)
                    <a href="{{ route('register') }}" class="text-white bg-green-600 hover:bg-green-700 px-3 py-2 rounded-lg text-sm md:text-base transition duration-300 transform hover:scale-105 shadow-sm">
                        <i class="fas fa-user-plus mr-1"></i> Daftar
                    </a>
                @endif
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Period Status Banner -->
        @if($isPeriodActive)
            <div class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-8 rounded-lg flex items-start shadow-sm">
                <i class="fas fa-check-circle text-2xl mr-3 mt-1 text-green-600"></i>
                <div>
                    <p class="font-bold text-lg">Pendaftaran {{ $activePeriod->name }} Sedang Dibuka!</p>
                    <p class="flex items-center text-sm md:text-base">
                        <i class="far fa-calendar-alt mr-2"></i> 
                        Periode: {{ \Carbon\Carbon::parse($activePeriod->startDate)->translatedFormat('d F Y') }} - 
                        {{ \Carbon\Carbon::parse($activePeriod->endDate)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-8 rounded-lg flex items-start shadow-sm">
                <i class="fas fa-exclamation-circle text-2xl mr-3 mt-1 text-yellow-600"></i>
                <div>
                    <p class="font-bold text-lg">Pendaftaran Belum Dibuka</p>
                    <p class="text-sm md:text-base">Silakan cek kembali di waktu yang telah ditentukan.</p>
                    
                    @php
                        $nextPeriod = \App\Models\PeriodePPDB::where('startDate', '>', now())
                                            ->orderBy('startDate', 'asc')
                                            ->first();
                    @endphp
                    
                    @if($nextPeriod)
                    <p class="mt-2 flex items-center text-sm md:text-base">
                        <i class="far fa-clock mr-2"></i> 
                        Pendaftaran berikutnya: {{ \Carbon\Carbon::parse($nextPeriod->startDate)->translatedFormat('d F Y') }}
                    </p>
                    <p class="flex items-center text-sm md:text-base">
                        <i class="far fa-clock mr-2"></i> 
                        Ditutup: {{ \Carbon\Carbon::parse($nextPeriod->endDate)->translatedFormat('d F Y') }}
                    </p>
                    @endif
                </div>
            </div>
        @endif

        <!-- Hero Section -->
        <section class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                Selamat Datang di PPDB<br>MA ITTAQU
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Bergabunglah dengan pendidikan berkualitas yang mengintegrasikan ilmu pengetahuan 
                dengan nilai-nilai Islami berdasarkan Al-Qur'an dan Sunnah.
            </p>
        </section>

        <!-- Why Choose Us -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-16">
            <div class="order-2 md:order-1">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6">
                    <span class="border-b-2 border-blue-600 pb-2">Keunggulan MA ITTAQU</span>
                </h2>
                <ul class="space-y-4">
                    <li class="flex items-start bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                            <i class="fas fa-quran text-sm"></i>
                        </span>
                        <span class="text-gray-700">Berlandaskan tuntunan Al-Qur'an dan Sunnah dengan pemahaman Ahlusunnah Wal Jama'ah</span>
                    </li>
                    <li class="flex items-start bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                            <i class="fas fa-hands-helping text-sm"></i>
                        </span>
                        <span class="text-gray-700">Pendidikan akhlaq mulia mengikuti contoh Rasulullah shallallahu 'alaihi wasallam</span>
                    </li>
                    <li class="flex items-start bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                            <i class="fas fa-globe-asia text-sm"></i>
                        </span>
                        <span class="text-gray-700">Membentuk generasi muslim yang rahmatan lil'alamin</span>
                    </li>
                    <li class="flex items-start bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                            <i class="fas fa-user-shield text-sm"></i>
                        </span>
                        <span class="text-gray-700">Pengembangan karakter: jujur, disiplin, tanggung jawab, dan kerjasama</span>
                    </li>
                    <li class="flex items-start bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3 flex-shrink-0">
                            <i class="fas fa-brain text-sm"></i>
                        </span>
                        <span class="text-gray-700">Pembelajaran yang menstimulus berpikir kritis, kreatif dan inovatif</span>
                    </li>
                </ul>
            </div>
            <div class="order-1 md:order-2">
                <div class="relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('img/maittaqu.png') }}" alt="MA ITTAQU" class="w-full h-auto object-cover transition duration-500 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-bold">MA ITTAAQU</h3>
                            <p class="text-sm">Fasilitas lengkap untuk mendukung proses belajar mengajar</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        @if($isPeriodActive)
        <section class="bg-white rounded-xl shadow-md overflow-hidden mb-16">
            <div class="bg-blue-700 text-white p-6">
                <h2 class="text-2xl font-bold text-center">
                    <i class="fas fa-file-contract mr-2"></i> Persyaratan Pendaftaran dan Rincian Pembayaran
                </h2>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="prose max-w-4xl mx-auto">
                    <div class="bg-blue-50 p-6 rounded-lg mb-6 border border-blue-100">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                            <i class="fas fa-file-alt mr-2"></i> Persyaratan Umum
                        </h3>
                        {!! $agreementContent !!}
                    </div>
                    
                    <div class="bg-green-50 p-6 rounded-lg mb-6 border border-green-100">
                        <h3 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                            <i class="fas fa-money-bill-wave mr-2"></i> Informasi Pembayaran
                        </h3>
                        {!! $informasiPembayaran !!}
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-xl shadow-md overflow-hidden mb-16">
            <div class="bg-blue-700 text-white p-6">
                <h2 class="text-2xl font-bold text-center">
                    <i class="fas fa-file-contract mr-2"></i> Matsama / Orientasi 
                </h2>
            </div>
            
        <div class="p-6">
        @if($orientasi->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-20">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            
                            <th class="px-6 py-3 text-left text-xs font-bold text-black-500 uppercase tracking-wider">Hari/Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-black-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-black-500 uppercase tracking-wider">Kegiatan</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-black-500 uppercase tracking-wider">Keterangan</th>
                            
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orientasi as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->datetime_start)->translatedFormat('l') }}<br>
                                    {{ \Carbon\Carbon::parse($item->datetime_start)->translatedFormat('d F Y') }}
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->keterangan ?? '-' }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-info-circle text-2xl mb-2"></i>
                <p>Jadwal orientasi belum tersedia</p>
            </div>
        @endif
    </div>
            


        </section>

        @endif

        
        <section class="text-center my-16">
            @if($isPeriodActive)
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">Siap Bergabung dengan MA ITTAQU?</h2>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Daftarkan diri Anda sekarang sebelum periode pendaftaran berakhir pada
                    {{ \Carbon\Carbon::parse($activePeriod->endDate)->translatedFormat('d F Y') }}.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
                    <a href="{{ route('register') }}" class="text-white bg-green-600 hover:bg-green-700 px-6 py-3 rounded-lg shadow-md transition duration-300 transform hover:scale-105 flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg shadow-md transition duration-300 transform hover:scale-105 flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login Peserta
                    </a>
                </div>
                
                
                <div class="mt-8 bg-gradient-to-r from-blue-100 to-indigo-100 p-6 rounded-xl shadow-inner max-w-2xl mx-auto">
                    <p class="text-center text-blue-800 font-medium mb-4">
                        <i class="far fa-clock mr-2"></i> Waktu pendaftaran tersisa:
                    </p>
                    
                    <div id="countdown" class="flex flex-wrap items-center justify-center gap-2 md:gap-4">
                        
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-700 text-white text-xl md:text-2xl font-bold px-4 py-2 rounded-lg w-16 md:w-20 text-center">
                                <span id="countdown-days">22</span>
                            </div>
                            <span class="text-xs md:text-sm text-blue-800 mt-1">Hari</span>
                        </div>
                        
                        
                        <div class="text-blue-700 font-bold text-xl md:text-2xl h-full flex items-center hidden sm:block">:</div>
                        
                        
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-700 text-white text-xl md:text-2xl font-bold px-4 py-2 rounded-lg w-16 md:w-20 text-center">
                                <span id="countdown-hours">11</span>
                            </div>
                            <span class="text-xs md:text-sm text-blue-800 mt-1">Jam</span>
                        </div>
                        
                        
                        <div class="text-blue-700 font-bold text-xl md:text-2xl h-full flex items-center hidden sm:block">:</div>
                        
                        
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-700 text-white text-xl md:text-2xl font-bold px-4 py-2 rounded-lg w-16 md:w-20 text-center">
                                <span id="countdown-minutes">19</span>
                            </div>
                            <span class="text-xs md:text-sm text-blue-800 mt-1">Menit</span>
                        </div>
                        
                        
                        <div class="text-blue-700 font-bold text-xl md:text-2xl h-full flex items-center hidden sm:block">:</div>
                        
                        
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-700 text-white text-xl md:text-2xl font-bold px-4 py-2 rounded-lg w-16 md:w-20 text-center">
                                <span id="countdown-seconds">54</span>
                            </div>
                            <span class="text-xs md:text-sm text-blue-800 mt-1">Detik</span>
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
                                el.classList.remove('bg-blue-700', 'bg-blue-600', 'bg-blue-500', 'bg-blue-400');
                                el.classList.add('bg-red-600');
                            });
                        }
                        
                        if (distance < 0) {
                            clearInterval(timer);
                            document.getElementById("countdown").innerHTML = `
                                <div class="bg-red-600 text-white px-6 py-3 rounded-lg font-bold col-span-4">
                                    <i class="fas fa-exclamation-circle mr-2"></i> PENDAFTARAN TELAH DITUTUP
                                </div>
                            `;
                            location.reload();
                        }
                    }, 1000);
                </script>
            @else
                <div class="bg-white p-8 rounded-xl shadow-md max-w-2xl mx-auto">
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">Pendaftaran Saat Ini Ditutup</h2>
                    <p class="text-gray-600 mb-6">
                        Pendaftaran peserta didik baru saat ini belum dibuka. Silakan pantau informasi terbaru 
                        melalui website kami atau media sosial resmi MA ITTAQU.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('login') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg shadow-md inline-flex items-center">
                            <i class="fas fa-lock-open mr-2"></i> Login Admin
                        </a>
                        
                    </div>
                </div>
            @endif
        </section>
    </main>

    
    <footer class="bg-gray-800 text-white pt-12 pb-6">
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
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@ypittaqusurabaya3563" class="text-gray-300 hover:text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=+6285815061414&text=Assalamualaikum, Saya ingin bertanya " class="text-gray-300 hover:text-white">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i> Beranda</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i> Tentang Kami</a></li>
                        
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i> Galeri</a></li>
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
                            <span>(+62)82335040234</span>
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
                    <form class="flex">
                        <input type="email" placeholder="Alamat Email" class="px-3 py-2 text-sm text-gray-800 rounded-l-lg focus:outline-none w-full">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-r-lg text-sm">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} MA ITTAQU</p>
                <div class="mt-2 flex justify-center space-x-4">
                    <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                    
                </div>
            </div>
        </div>
    </footer>
</body>
</html>