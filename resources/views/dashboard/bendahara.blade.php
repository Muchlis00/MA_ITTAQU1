<style>
.dataTable-dropdown select {
  appearance: none !important;
  padding: 0.25rem 0rem 0.25rem 0.5rem !important;
  border: 1px solid #d1d5db !important; 
  border-radius: 0.375rem !important; 
  background-color: white !important;
  //background-image: url("data:image/svg+xml,%3Csvg fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") !important;
  background-repeat: no-repeat !important;
  background-position: right 0.2rem center !important;
  background-size: 1em !important;
  width: auto !important;
  min-width: 3rem !important;
  font-size: 0.875rem !important; 
}
</style>
<x-app-layout>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <table class="simple-datatables w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Periode</th>
                    <th class="px-4 py-2">Tipe pembayaran</th>
                    <th class="px-4 py-2">Status Pendaftarn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftar as $item)
                @php
                    $pembayaranItem = $pembayaran->firstWhere('user_id', $item->user_id);
                @endphp
                <tr>
                    <td class="border px-4 py-2">{{$item->periode->name}} ({{Carbon\Carbon::parse($item->periode->startDate)->format('d-m-Y')}} - {{Carbon\Carbon::parse($item->periode->endDate)->format('d-m-Y')}})</td>
                    <td class="border px-4 py-2">{{$item->user->name}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->nisn}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->gender}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->place_of_birth}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->date_of_birth}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->phone}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->child_number}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->sibling}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->previous_school_name}}</td>
                    <td class="hidden">{{$item->dataDiriPendaftar->previous_school_address}}</td>
                    
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->name}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->address}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->phone}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->place_of_birth}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->date_of_birth}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->gender}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->pekerjaan}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Laki-Laki')->pendapatan}}</td>

                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->name}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->address}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->phone}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->place_of_birth}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->date_of_birth}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->gender}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->pekerjaan}}</td>
                    <td class="hidden">{{$item->wali->firstWhere('gender','Perempuan')->pendapatan}}</td>
                    
                    <td class="hidden">{{$item->ready_to_verify ? 'Sudah kirim' : 'Telah Terverifikasi'}} </td>
                    <td class="hidden">{{$item->verification_status}}</td>

                    <td class="border px-4 py-2">{{$pembayaranItem->status_pembayaran ?? null }}</td>
                    <td class="border px-4 py-2">{{$pembayaranItem->verification_status ?? null}}</td>
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