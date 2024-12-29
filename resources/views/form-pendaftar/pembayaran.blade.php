@extends('form-pendaftar.index')

@section('form-pendaftar')

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
                <label for="bukti_pembayaran" class="w-48 whitespace-nowrap text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                <input type="file" accept="image/*" name="bukti_pembayaran" id="bukti_pembayaran"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            </div>
            

        </div>
        @if (!empty($currentPembayaran))
            @foreach ( $currentPembayaran as $pembayaran)
            <div class="max-w-xs mx-auto">
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

@endsection