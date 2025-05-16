<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pembayaran Sewa Kios') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               

                <div class="p-6">
                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pembayaran.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="sewa_id" value="{{ $sewa->id }}">

                        <!-- Order Summary -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Pembayaran</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama Kios:</span>
                                    <span class="font-medium">{{ $sewa->kios->nama }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga Sewa/bulan:</span>
                                    <span>Rp {{ number_format($sewa->kios->harga_sewa, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Durasi:</span>
                                    <span>{{ $sewa->durasi }} bulan</span>
                                </div>
                                <div class="border-t border-gray-200 my-2"></div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-semibold">Total Pembayaran:</span>
                                    <span class="text-xl font-bold text-green-600">
                                        Rp {{ number_format($sewa->kios->harga_sewa * $sewa->durasi, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Metode Pembayaran</h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <input type="radio" name="metode_pembayaran" id="transfer" value="transfer" class="hidden peer" checked required>
                                    <label for="transfer" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        <span class="mt-2 font-medium">Transfer Bank</span>
                                        <span class="text-xs text-gray-500 mt-1">BNI, BRI, Mandiri, dll</span>
                                    </label>
                                </div>
                                
                                <div>
                                    <input type="radio" name="metode_pembayaran" id="ewallet" value="ewallet" class="hidden peer" required>
                                    <label for="ewallet" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="mt-2 font-medium">E-Wallet</span>
                                        <span class="text-xs text-gray-500 mt-1">OVO, Dana, Gopay</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Bank Account Info (shown when bank transfer selected) -->
                            <div id="bank-info" class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <h4 class="font-medium text-blue-800 mb-2">Rekening Pembayaran</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Bank:</span>
                                        <span class="font-medium">Bank ABC</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">No. Rekening:</span>
                                        <span class="font-medium">123 456 7890</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Atas Nama:</span>
                                        <span class="font-medium">PT Sewa Kios Kita</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Proof -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Upload Bukti Pembayaran</h3>
                            
                            <div class="flex items-center justify-center w-full">
                                <label for="bukti_pembayaran" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500">JPEG, PNG, JPG (Maks. 2MB)</p>
                                    </div>
                                    <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg" required />
                                </label>
                            </div>
                            
                            <!-- Preview container -->
                            <div id="preview-container" class="hidden mt-2">
                                <p class="text-sm font-medium text-gray-700 mb-1">Pratinjau:</p>
                                <div class="border rounded-md p-2 inline-block">
                                    <img id="preview-image" class="h-32" src="" alt="Pratinjau bukti pembayaran">
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" required class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">Saya menyetujui</label>
                                <p class="text-gray-500">Dengan mengklik Konfirmasi Pembayaran, Anda menyetujui Syarat & Ketentuan yang berlaku.</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview image upload
        document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('preview-image').src = event.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Toggle bank info visibility based on payment method
        const bankInfo = document.getElementById('bank-info');
        document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
            radio.addEventListener('change', function() {
                bankInfo.style.display = this.value === 'transfer' ? 'block' : 'none';
            });
        });
    </script>
</x-app-layout>