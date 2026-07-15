@extends('form-pendaftar.index')

@section('form-pendaftar')

<div>
    <div class="bg-gray-50 p-4 rounded-md flex flex-col gap-6">
        <div>
            <h2 class="text-2xl font-bold leading-tight text-gray-900">Rincian Pembayaran</h2>
            <div>Periode PPDB: {{ date('F Y', strtotime($currentPeriode->startDate)) . ' - ' . date('F Y', strtotime($currentPeriode->endDate)) }}</div>
        </div>
        @php
            $gender = strtolower($currentDataDiriPendaftar->gender ?? '');
            $isPutri = str_contains($gender, 'perempuan') || str_contains($gender, 'putri');
            $isPutra = str_contains($gender, 'laki') || str_contains($gender, 'putra');
            
            $info = $informasiPembayaran;
            $administrasi = ($info && !empty($info->biaya_administrasi)) ? $info->biaya_administrasi : [];
            $atribut = ($info && !empty($info->biaya_atribut)) ? $info->biaya_atribut : [];
            
            $total_administrasi = collect($administrasi)->sum('jumlah');
            $total_atribut_putra = collect($atribut)->sum('putra');
            $total_atribut_putri = collect($atribut)->sum('putri');
            $grand_total_putra = $total_administrasi + $total_atribut_putra;
            $grand_total_putri = $total_administrasi + $total_atribut_putri;
            
            $min_pembayaran = ($info && $info->minimal_pembayaran_pertama !== null) ? $info->minimal_pembayaran_pertama : 50;
            $potongan_lunas = ($info && $info->potongan_lunas !== null) ? $info->potongan_lunas : 0;
            $hasData = !empty($administrasi) || !empty($atribut);
        @endphp

        @if($hasData && $isPutra)
        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg text-blue-900 shadow-sm">
            <div class="flex items-center gap-2 font-bold mb-1">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Informasi Pembayaran (Siswa Putra)</span>
            </div>
            <p class="text-sm">
                Total Biaya: <strong>Rp. {{ number_format($grand_total_putra, 0, ',', '.') }},-</strong><br>
                Minimal Pembayaran Pertama ({{ $min_pembayaran }}%): <strong>Rp. {{ number_format($grand_total_putra * ($min_pembayaran / 100), 0, ',', '.') }},-</strong>
                @if($potongan_lunas > 0)
                <br>Pembayaran LUNAS (Mendapat Potongan Rp. {{ number_format($potongan_lunas, 0, ',', '.') }}): <strong class="text-green-700">Rp. {{ number_format($grand_total_putra - $potongan_lunas, 0, ',', '.') }},-</strong>
                @endif
            </p>
        </div>
        @elseif($hasData && $isPutri)
        <div class="mb-6 p-4 bg-pink-50 border-l-4 border-pink-500 rounded-r-lg text-pink-900 shadow-sm">
            <div class="flex items-center gap-2 font-bold mb-1">
                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Informasi Pembayaran (Siswi Putri)</span>
            </div>
            <p class="text-sm">
                Total Biaya: <strong>Rp. {{ number_format($grand_total_putri, 0, ',', '.') }},-</strong><br>
                Minimal Pembayaran Pertama ({{ $min_pembayaran }}%): <strong>Rp. {{ number_format($grand_total_putri * ($min_pembayaran / 100), 0, ',', '.') }},-</strong>
                @if($potongan_lunas > 0)
                <br>Pembayaran LUNAS (Mendapat Potongan Rp. {{ number_format($potongan_lunas, 0, ',', '.') }}): <strong class="text-green-700">Rp. {{ number_format($grand_total_putri - $potongan_lunas, 0, ',', '.') }},-</strong>
                @endif
            </p>
        </div>
        @endif

        <div>
            @include('partials.rincian-pembayaran-table', ['info' => $informasiPembayaran])
        </div>
    </div>
    <form action={{ route('formulir-ppdb.storePembayaran') }} enctype="multipart/form-data" method="POST" class="space-y-6">
        @csrf
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <input type="hidden" name="id_periode" value="{{ $currentPeriode->id_periode }}">
        <input type="hidden" name="user_id" value="{{ $currentUser->id }}">
        <div class="bg-gray-50 p-4 rounded-md flex flex-col gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-row items-center gap-4">
                    <label for="bukti_pembayaran" class="w-48 whitespace-nowrap text-sm font-medium text-gray-700">Bukti Pembayaran <span class="required">*</span></label>
                    <input type="file" accept="image/*" name="bukti_pembayaran" id="bukti_pembayaran"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>

                </div>


            </div>
            @if (!empty($currentPembayaran))
            @foreach ( $currentPembayaran as $pembayaran)
            <div class="max-w-xs ml-auto">
                <img alt={{ $pembayaran->bukti_pembayaran }} src={{ asset('storage/' . $pembayaran->bukti_pembayaran) }} class="rounded-md shadow" style="max-width: 10em; max-height: 10em;">
            </div>
            @endforeach
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection