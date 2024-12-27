
<form method="POST" class="space-y-6">
    @csrf
    <div class="bg-gray-50 p-4 rounded-md">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Pendaftar</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Pendaftar -->
            <div class="md:col-span-2">
                <label for="nama_pendaftar" class="block text-sm font-medium text-gray-700">Nama Pendaftar</label>
                <input type="text" name="nama_pendaftar" id="nama_pendaftar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- TTL Pendaftar -->
            <div>
                <label for="ttl_pendaftar" class="block text-sm font-medium text-gray-700">Tempat & Tanggal Lahir Pendaftar</label>
                <input type="text" name="ttl_pendaftar" id="ttl_pendaftar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- NISN -->
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700">Nomor NISN</label>
                <input type="text" name="nisn" id="nisn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Anak ke & Jumlah Saudara -->
            <div>
                <label for="anak_ke" class="block text-sm font-medium text-gray-700">Anak ke</label>
                <input type="number" name="anak_ke" id="anak_ke" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="jumlah_saudara" class="block text-sm font-medium text-gray-700">Jumlah Saudara</label>
                <input type="number" name="jumlah_saudara" id="jumlah_saudara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Data Sekolah Asal -->
            <div>
                <label for="sekolah_asal" class="block text-sm font-medium text-gray-700">Nama Sekolah Asal</label>
                <input type="text" name="sekolah_asal" id="sekolah_asal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="telepon_pendaftar" class="block text-sm font-medium text-gray-700">No. Telepon Pendaftar</label>
                <input type="tel" name="telepon_pendaftar" id="telepon_pendaftar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div class="md:col-span-2">
                <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700">Alamat Sekolah Asal</label>
                <textarea name="alamat_sekolah" id="alamat_sekolah" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>
        </div>
    </div>

    <!-- Next Button -->
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Lanjutkan
        </button>
    </div>
</form>