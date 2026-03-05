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
                                <th class="px-4 py-2">Status Pembayaran</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBuktiBayar as $buktiBayar)
                            <tr>
                                <td class="border px-4 py-2">{{ $buktiBayar->user->name }}</td>
                                <td class="border px-4 py-2">
                                    <img src="{{ asset('storage/' . $buktiBayar->bukti_pembayaran) }}"
                                        alt="Bukti Bayar"
                                        class="max-w-32 max-h-32 mx-auto w-auto object-cover rounded shadow-sm hover:shadow-lg transition-shadow duration-200 cursor-pointer"
                                        onclick="window.open(this.src, '_blank')">
                                </td>
                                <td class="border px-4 py-2">
                                    @php
                                        $statusClass = '';
                                        $statusIcon = '';
                                        $statusText = $buktiBayar->status_pembayaran;
                                        
                                        switch($buktiBayar->status_pembayaran) {
                                            case 'Lunas':
                                                $statusClass = 'bg-green-100 text-green-800';
                                                $statusIcon = '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                                                break;
                                            case '40%':
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                                $statusIcon = '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                                                break;
                                            case 'Belum Lunas':
                                            default:
                                                $statusClass = 'bg-red-100 text-red-800';
                                                $statusIcon = '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                                                break;
                                        }
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                        {!! $statusIcon !!}
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex justify-center space-x-3">
                                        <button
                                            data-id="{{ $buktiBayar->id }}"
                                            onclick="openPaymentStatusModal(this.dataset.id)"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-200">
                                           
                                            Verifikasi
                                        </button>
                                        <button
                                            data-id="{{ $buktiBayar->id }}"
                                            onclick="openModal(this.dataset.id)"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors duration-200">
                                          
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
    @include('verify-payment.payment-status-modal')
    
    <script>
        let currentPaymentId = null;
        const rejectionModal = document.getElementById('rejectionModal');

        let currentPaymentStatusId = null;
        const paymentModal = document.getElementById('paymentStatusModal');
        const statusSelect = document.getElementById('status_pembayaran');
        const statusPreview = document.getElementById('statusPreview');
        const statusBadge = document.getElementById('statusBadge');

        function openModal(paymentId) {
            currentPaymentId = paymentId;
            rejectionModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            rejectionModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('rejectionReason').value = '';
            currentPaymentId = null;
        }

        function submitRejection() {
            const reason = document.getElementById('rejectionReason').value;
            if (!reason.trim()) {
                alert('Mohon isi alasan penolakan');
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/verify-payment/reject/${currentPaymentId}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const reasonInput = document.createElement('input');
            reasonInput.type = 'hidden';
            reasonInput.name = 'rejection_reason';
            reasonInput.value = reason;
            form.appendChild(reasonInput);

            document.body.appendChild(form);
            form.submit();
        }

        function openPaymentStatusModal(id) {
            currentPaymentStatusId = id;
            document.getElementById('payment_id').value = id;
            paymentModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            document.getElementById('paymentStatusForm').reset();
            statusPreview.classList.add('hidden');
        }

        function closePaymentStatusModal() {
            paymentModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentPaymentStatusId = null;
            document.getElementById('paymentStatusForm').reset();
            statusPreview.classList.add('hidden');
        }

        statusSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            
            if (selectedValue) {
                statusPreview.classList.remove('hidden');
                statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium';
                
                switch(selectedValue) {
                    case 'Belum Lunas':
                        statusBadge.classList.add('bg-red-100', 'text-red-800');
                        statusBadge.innerHTML = `
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Belum Lunas
                        `;
                        break;
                    case '40%':
                        statusBadge.classList.add('bg-yellow-100', 'text-yellow-800');
                        statusBadge.innerHTML = `
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            40%
                        `;
                        break;
                    case 'Lunas':
                        statusBadge.classList.add('bg-green-100', 'text-green-800');
                        statusBadge.innerHTML = `
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Lunas
                        `;
                        break;
                }
            } else {
                statusPreview.classList.add('hidden');
            }
        });

        document.getElementById('paymentStatusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const status = formData.get('status_pembayaran');
            
            if (!status) {
                alert('Silakan pilih status pembayaran');
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/verify-payment/update-status/${formData.get('payment_id')}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status_pembayaran';
            statusInput.value = status;
            form.appendChild(statusInput);

            const catatanInput = document.createElement('input');
            catatanInput.type = 'hidden';
            catatanInput.name = 'catatan';
            catatanInput.value = formData.get('catatan') || '';
            form.appendChild(catatanInput);

            document.body.appendChild(form);
            form.submit();
        });

        rejectionModal.addEventListener('click', function(event) {
            if (event.target === rejectionModal || event.target.classList.contains('bg-opacity-75')) {
                closeModal();
            }
        });

        paymentModal.addEventListener('click', function(event) {
            if (event.target === paymentModal || event.target.classList.contains('bg-opacity-75')) {
                closePaymentStatusModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                if (!rejectionModal.classList.contains('hidden')) {
                    closeModal();
                } else if (!paymentModal.classList.contains('hidden')) {
                    closePaymentStatusModal();
                }
            }
        });
    </script>
    @vite('resources/js/simple-datatables.js')
</x-app-layout>