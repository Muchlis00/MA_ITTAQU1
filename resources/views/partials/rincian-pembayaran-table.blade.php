
@php
    $administrasi = ($info && !empty($info->biaya_administrasi)) ? $info->biaya_administrasi : [];
    $atribut = ($info && !empty($info->biaya_atribut)) ? $info->biaya_atribut : [];

    $total_administrasi = collect($administrasi)->sum('jumlah');
    $total_atribut_putra = collect($atribut)->sum('putra');
    $total_atribut_putri = collect($atribut)->sum('putri');

    $grand_total_putra = $total_administrasi + $total_atribut_putra;
    $grand_total_putri = $total_administrasi + $total_atribut_putri;

    $min_pembayaran = ($info && $info->minimal_pembayaran_pertama !== null) ? $info->minimal_pembayaran_pertama : 50;
    $potongan_lunas = ($info && $info->potongan_lunas !== null) ? $info->potongan_lunas : 0;
@endphp

@if(empty($administrasi) && empty($atribut))
<div class="p-6 text-center text-gray-500 bg-gray-50 rounded-lg border border-gray-200">
    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <p class="text-lg font-medium">Informasi pembayaran belum tersedia</p>
</div>
@else
<div class="space-y-6">
    @if(!empty($administrasi))
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th colspan="3" class="px-4 py-3 text-left font-bold text-gray-900 border-b border-gray-200 bg-gray-100 uppercase tracking-wider">
                        BIAYA ADMINISTRASI MADRASAH :
                    </th>
                </tr>
                <tr class="text-left text-xs font-semibold text-gray-500 border-b border-gray-200 uppercase">
                    <th class="px-4 py-2.5 text-center w-16 border-r border-gray-200">NO.</th>
                    <th class="px-4 py-2.5 border-r border-gray-200">JENIS ADMINISTRASI</th>
                    <th class="px-4 py-2.5 text-right w-48">JUMLAH</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach($administrasi as $index => $item)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-4 py-2.5 text-center border-r border-gray-200 font-medium text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-4 py-2.5 border-r border-gray-200 font-medium">{{ $item['nama'] ?? '-' }}</td>
                    <td class="px-4 py-2.5 text-right font-semibold">Rp. {{ number_format($item['jumlah'] ?? 0, 0, ',', '.') }},-</td>
                </tr>
                @endforeach
                <tr class="bg-gray-50 font-bold border-t-2 border-gray-300 text-gray-900">
                    <td colspan="2" class="px-4 py-3 text-center border-r border-gray-200 uppercase tracking-wider text-xs">Jumlah</td>
                    <td class="px-4 py-3 text-right text-base text-blue-900">Rp. {{ number_format($total_administrasi, 0, ',', '.') }},-</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif

    @if(!empty($atribut))
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th colspan="4" class="px-4 py-3 text-left font-bold text-gray-900 border-b border-gray-200 bg-gray-100 uppercase tracking-wider">
                        BIAYA ATRIBUT SISWA / SISWI :
                    </th>
                </tr>
                <tr class="text-left text-xs font-semibold text-gray-500 border-b border-gray-200 uppercase">
                    <th class="px-4 py-2.5 text-center w-16 border-r border-gray-200">NO.</th>
                    <th class="px-4 py-2.5 border-r border-gray-200">JENIS PERLENGKAPAN</th>
                    <th class="px-4 py-2.5 text-right border-r border-gray-200 w-40">PUTRA</th>
                    <th class="px-4 py-2.5 text-right w-40">PUTRI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach($atribut as $index => $item)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-4 py-2.5 text-center border-r border-gray-200 font-medium text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-4 py-2.5 border-r border-gray-200 font-medium">{{ $item['nama'] ?? '-' }}</td>
                    <td class="px-4 py-2.5 text-right border-r border-gray-200 font-semibold {{ ($item['putra'] ?? 0) == 0 ? 'text-gray-400 text-center' : '' }}">
                        {{ ($item['putra'] ?? 0) == 0 ? '-' : 'Rp. ' . number_format($item['putra'], 0, ',', '.') . ',-' }}
                    </td>
                    <td class="px-4 py-2.5 text-right font-semibold {{ ($item['putri'] ?? 0) == 0 ? 'text-gray-400 text-center' : '' }}">
                        {{ ($item['putri'] ?? 0) == 0 ? '-' : 'Rp. ' . number_format($item['putri'], 0, ',', '.') . ',-' }}
                    </td>
                </tr>
                @endforeach
                <tr class="bg-gray-50 font-bold border-t-2 border-gray-300 text-gray-900">
                    <td colspan="2" class="px-4 py-3 text-center border-r border-gray-200 uppercase tracking-wider text-xs">Jumlah</td>
                    <td class="px-4 py-3 text-right border-r border-gray-200 text-base text-blue-900">Rp. {{ number_format($total_atribut_putra, 0, ',', '.') }},-</td>
                    <td class="px-4 py-3 text-right text-base text-pink-900">Rp. {{ number_format($total_atribut_putri, 0, ',', '.') }},-</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif

    @if(!empty($administrasi) || !empty($atribut))
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <tbody class="divide-y divide-gray-200">
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 font-bold text-gray-900">
                    <td class="px-4 py-4 text-center border-r border-gray-200 uppercase tracking-wider font-extrabold text-xs md:text-sm">JUMLAH TOTAL YANG DIBAYAR</td>
                    <td class="px-4 py-4 text-right border-r border-gray-200 w-48 text-blue-700 font-extrabold text-base">PUTRA: Rp. {{ number_format($grand_total_putra, 0, ',', '.') }},-</td>
                    <td class="px-4 py-4 text-right w-48 text-pink-700 font-extrabold text-base">PUTRI: Rp. {{ number_format($grand_total_putri, 0, ',', '.') }},-</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-100 rounded-lg text-sm text-gray-700 space-y-1 shadow-sm">
        <div><strong>Keterangan :</strong></div>
        <ul class="list-disc pl-5 space-y-1 font-medium">
            <li>Pembayaran pertama minimal <strong class="text-blue-700">{{ $min_pembayaran }}%</strong>.</li>
            @if($potongan_lunas > 0)
            <li>Bagi yang membayar <strong class="text-green-700">LUNAS</strong> mendapat potongan <strong class="text-green-700">Rp. {{ number_format($potongan_lunas, 0, ',', '.') }},-</strong>.</li>
            @endif
        </ul>
    </div>
    @endif
</div>
@endif
