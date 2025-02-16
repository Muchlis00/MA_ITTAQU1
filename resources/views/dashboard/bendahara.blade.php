<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <table class="simple-datatables w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Periode</th>
                    <th class="px-4 py-2">Tipe pembayaran</th>
                    <th class="px-4 py-2">Status Pendaftarn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftar as $item)
                <tr>
                    <td class="border px-4 py-2">{{$item->user->name}}</td>
                    <td class="border px-4 py-2">{{$item->periode->name}} ({{Carbon\Carbon::parse($item->datetime_start)->format('d-m-Y')}} - {{Carbon\Carbon::parse($item->datetime_end)->format('d-m-Y')}})</td>
                    <td class="border px-4 py-2">{{$item->status_pembayaran ? 'lunas' : 'belum lunas'}} </td>
                    <td class="border px-4 py-2">{{$item->verification_status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="simple-datatables-export-button bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Export to CSV
        </button>
    </div>

    @vite('resources/js/simple-datatables.js')
</x-app-layout>