<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB MA ITTAQU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">PPDB MA ITTAQU</h1>
            <nav>
                <a href="{{ route('login') }}" class="text-gray-800 hover:text-blue-600 px-4">Login</a>
                <a href="{{ route('register') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Register</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-16">
        <section class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Selamat Datang di Pendaftaran Peserta Didik Baru</h2>
            <p class="text-lg text-gray-600">Daftar untuk menjadi bagian dari pendidikan berkualitas di MA ITTAQU.</p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <img src="img/maittaqu.png" alt="MA ITTAQU" class="rounded-lg shadow-lg w-1/2 mx-auto">
            </div>
            <div>
                <h3 class="text-3xl font-semibold text-gray-800 mb-4">Kenapa Memilih MA ITTAQU?</h3>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li>Berlandaskan tuntunan Al-Qur’an, Sunnah Rasul dengan pemahaman Ahlusunnah Wal Jama’ah</li>
                    <li>Berlandaskan pada akhlaq mulia Rasulullah shallahu’alaihi wasallam</li>
                    <li>Berorientasi sebagai ummat yang rahmatan lil’alamin</li>
                    <li>Bersikap benar, jujur, disiplin, tanggung jawab, santun dan ceria, terbuka, dan bekerjasama</li>
                    <li>Berpikir logis, kritis, kreatif dan inovatif</li>
                </ul>
            </div>
        </section>

        <section class="text-center mt-16">
            <h3 class="text-3xl font-semibold text-gray-800 mb-4">Mulai Pendaftaran Anda Sekarang</h3>
            <p class="text-gray-600 mb-6">Klik tombol di bawah ini untuk login atau mendaftar sebagai calon peserta didik.</p>
            <a href="{{ route('register') }}" class="text-white bg-green-500 hover:bg-green-600 px-6 py-3 rounded-lg shadow-md mr-4">Daftar Sekarang</a>
            <a href="{{ route('login') }}" class="text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg shadow-md">Login</a>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-16">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} MA ITTAQU. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
