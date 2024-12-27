<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role != 'pendaftar')
            Selamat datang {{Auth::user()->role}}
            @endif

            @if (Auth::user()->role == 'pendaftar')
            Formulir Pendaftaran
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Auth::user()->role == 'pendaftar')
           @include('form-pendaftar.index')
            @endif
        </div>
    </div>
</x-app-layout>