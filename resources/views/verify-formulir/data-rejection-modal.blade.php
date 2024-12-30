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

    <script>
        let currentPaymentId = null;
        const modal = document.getElementById('rejectionModal');

        function openModal(id) {
            currentId = id;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('rejectionReason').value = '';
            currentPaymentId = null;
        }

        // Close modal when clicking outside
        modal.addEventListener('click', function(event) {
            if (event.target === modal || event.target.classList.contains('bg-opacity-75')) {
                closeModal();
            }
        });

        function submitRejection() {
            const reason = document.getElementById('rejectionReason').value;
            if (!reason.trim()) {
                alert('Mohon isi alasan penolakan');
                return;
            }

            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/verify-formulir/reject/${currentId}`;

            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Add rejection reason
            const reasonInput = document.createElement('input');
            reasonInput.type = 'hidden';
            reasonInput.name = 'rejection_reason';
            reasonInput.value = reason;
            form.appendChild(reasonInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>