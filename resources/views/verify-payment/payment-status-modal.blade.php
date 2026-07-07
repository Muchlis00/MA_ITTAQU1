<div id="paymentStatusModal" class="hidden fixed inset-0 z-50">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Verifikasi Pembayaran
                        </h3>
                    </div>
                </div>

                <form id="paymentStatusForm" class="px-6 py-4">
                    @csrf
                    <input type="hidden" name="payment_id" id="payment_id">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Pembayaran
                            </label>
                            <select 
                                name="status_pembayaran" 
                                id="status_pembayaran"
                                class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                                <option value="">Pilih Status Pembayaran</option>
                                <!-- <option value="Belum Lunas">Belum Lunas</option> -->
                                <option value="50%">50%</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <!-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Catatan (Opsional)
                            </label>
                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="3"
                                class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div> -->

                        <div id="statusPreview" class="hidden">
                            <div class="p-3 rounded-lg border">
                                <p class="text-sm font-medium mb-1">Preview Status:</p>
                                <div id="statusBadge" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                    <button
                        type="button"
                        onclick="closePaymentStatusModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-colors">
                        Batal
                    </button>
                    <button
                        type="submit"
                        form="paymentStatusForm"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Simpan Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
