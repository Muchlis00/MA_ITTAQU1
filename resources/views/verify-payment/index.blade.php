<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900">Verifikasi Pembayaran</h2>
                <div class="mt-12">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Bukti Bayar</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBuktiBayar as $buktiBayar)
                            <tr>
                                <td class="border px-4 py-2">{{ $buktiBayar->user->name }}</td>
                                <td class="border px-4 py-2">
                                    <img src={{ asset('storage/' . $buktiBayar->bukti_pembayaran) }}
                                        alt="Bukti Bayar" class="max-w-32 max-h-32 mx-auto">
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex justify-around">
                                        <form action="{{ route('verify-payment.verify', $buktiBayar->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Verifikasi
                                            </button>
                                        </form>
                                        <button 
                                        data-id="{{ $buktiBayar->id }}"
                                            onclick="openModal(this.dataset.id)"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

   @include('verify-payment.payment-rejection-modal')
</x-app-layout>