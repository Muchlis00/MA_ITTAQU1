<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 text-white">PPDB</div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        @if(Auth::user()->role === 'kepala_sekolah')
                        <a href="{{ route('dashboard.kepala_sekolah') }}" class="text-gray-300 hover:text-white">Dashboard Kepala Sekolah</a>
                        @elseif(Auth::user()->role === 'panitia')
                        <a href="{{ route('dashboard.panitia') }}" class="text-gray-300 hover:text-white">Dashboard Panitia</a>
                        @elseif(Auth::user()->role === 'bendahara')
                        <a href="{{ route('dashboard.bendahara') }}" class="text-gray-300 hover:text-white">Dashboard Bendahara</a>
                        @elseif(Auth::user()->role === 'pendaftar')
                        <a href="{{ route('dashboard.pendaftar') }}" class="text-gray-300 hover:text-white">Dashboard Pendaftar</a>
                        @endif

                        <!-- Link umum, misalnya untuk login/logout -->
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ route('logout') }}" class="text-gray-300 hover:text-white">Logout</a>
                        @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login</a>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>