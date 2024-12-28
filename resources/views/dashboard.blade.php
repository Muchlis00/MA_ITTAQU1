<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role != 'pendaftar')
            Selamat datang {{Auth::user()->role}}
            @endif


        </h2>
    </x-slot>
</x-app-layout>