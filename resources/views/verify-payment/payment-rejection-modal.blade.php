 <!-- Rejection Modal -->
 <div id="rejectionModal" class="hidden fixed inset-0 z-50">
        <!-- Modal Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

        <!-- Modal Content -->
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Alasan Penolakan
                        </h3>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-4">
                        <textarea
                            id="rejectionReason"
                            class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500"
                            rows="4"
                            placeholder="Masukkan alasan penolakan..."></textarea>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-4">
                        <button
                            onclick="closeModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none">
                            Batal
                        </button>
                        <button
                            onclick="submitRejection()"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none">
                            Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>