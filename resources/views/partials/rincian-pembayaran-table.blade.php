@php
    $administrasi = ($info && !empty($info->biaya_administrasi)) ? $info->biaya_administrasi : [
        ["nama" => "Masa Ta'aruf Siswa Madrasah (MATSAMA) / MOS", "jumlah" => 100000],
        ["nama" => "Pengembangan Madrasah", "jumlah" => 300000],
        ["nama" => "Buku LKS semua mapel semester ganjil", "jumlah" => 300000],
        ["nama" => "Outbound Siswa", "jumlah" => 300000],
        ["nama" => "Kegiatan Siswa 1 tahun", "jumlah" => 100000],
        ["nama" => "Infaq bulan Juli 2023", "jumlah" => 100000],
        ["nama" => "Sampul Raport", "jumlah" => 60000]
    ];

    $atribut = ($info && !empty($info->biaya_atribut)) ? $info->biaya_atribut : [
        ["nama" => "Seragam Olahraga", "putra" => 200000, "putri" => 200000],
        ["nama" => "Jaz Almamater", "putra" => 200000, "putri" => 200000],
        ["nama" => "Dasi 1 buah", "putra" => 25000, "putri" => 25000],
        ["nama" => "Jilbab 3 buah (abu-abu, batik, pramuka)", "putra" => 0, "putri" => 150000],
        ["nama" => "Bedge dan lokasi 3 buah", "putra" => 25000, "putri" => 25000],
        ["nama" => "Kain batik", "putra" => 90000, "putri" => 90000]
    ];

    $total_administrasi = collect($administrasi)->sum('jumlah');
    $total_atribut_putra = collect($atribut)->sum('putra');
    $total_atribut_putri = collect($atribut)->sum('putri');

    $grand_total_putra = $total_administrasi + $total_atribut_putra;
    $grand_total_putri = $total_administrasi + $total_atribut_putri;

    $min_pembayaran = $info ? $info->minimal_pembayaran_pertama : 50;
    $potongan_lunas = $info ? $info->potongan_lunas : 150000;
@endphp

<div class="space-y-6">
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
                    <td class="px-4 py-2.5 border-r border-gray-200 font-medium">{{ $item['nama'] }}</td>
                    <td class="px-4 py-2.5 text-right font-semibold">Rp. {{ number_format($item['jumlah'], 0, ',', '.') }},-</td>
                </tr>
                @endforeach
                <tr class="bg-gray-50 font-bold border-t-2 border-gray-300 text-gray-900">
                    <td colspan="2" class="px-4 py-3 text-center border-r border-gray-200 uppercase tracking-wider text-xs">Jumlah</td>
                    <td class="px-4 py-3 text-right text-base text-blue-900">Rp. {{ number_format($total_administrasi, 0, ',', '.') }},-</td>
                </tr>
            </tbody>
        </table>
    </div>

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
                    <td class="px-4 py-2.5 border-r border-gray-200 font-medium">{{ $item['nama'] }}</td>
                    <td class="px-4 py-2.5 text-right border-r border-gray-200 font-semibold {{ $item['putra'] == 0 ? 'text-gray-400 text-center' : '' }}">
                        {{ $item['putra'] == 0 ? '-' : 'Rp. ' . number_format($item['putra'], 0, ',', '.') . ',-' }}
                    </td>
                    <td class="px-4 py-2.5 text-right font-semibold {{ $item['putri'] == 0 ? 'text-gray-400 text-center' : '' }}">
                        {{ $item['putri'] == 0 ? '-' : 'Rp. ' . number_format($item['putri'], 0, ',', '.') . ',-' }}
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
            <li>Bagi yang membayar <strong class="text-green-700">LUNAS</strong> mendapat potongan <strong class="text-green-700">Rp. {{ number_format($potongan_lunas, 0, ',', '.') }},-</strong>.</li>
        </ul>
    </div>
</div>
