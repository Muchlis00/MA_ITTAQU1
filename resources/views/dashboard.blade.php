<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (Auth::user()->role === 'kepsek')
                    <h1>Selamat datang kepsek</h1>
                    @elseif (Auth::user()->role === 'panitia')
                    <h1>Selamat datang panitia</h1>
                    @elseif (Auth::user()->role === 'bendahara')
                    <h1>Selamat datang bendahara</h1>
                    @elseif (Auth::user()->role === 'pendaftar')
                    <h1>Selamat datang pendaftar</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>