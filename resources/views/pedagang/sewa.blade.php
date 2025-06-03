<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Penyewaan Kios {{ $kios->nama_kios }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-yellow-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Informasi Kios -->
                    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Detail Kios</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama Kios:</span>
                                    <span class="font-medium">{{ $kios->nama_kios }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pasar:</span>
                                    <span>{{ $kios->pasar->nama_pasar }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Lokasi:</span>
                                    <span>{{ $kios->lokasi }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga Sewa:</span>
                                    <span class="font-medium">Rp {{ number_format($kios->harga_sewa, 0, ',', '.') }}/bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            @if($kios->image)
                                <img src="{{ Storage::url($kios->image) }}" 
                                     alt="Kios {{ $kios->nama_kios }}" 
                                     class="h-48 rounded-lg object-cover">
                            @else
                                <div class="h-48 w-full bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Sewa -->
                    <form method="POST" action="{{ route('sewa.store') }}">
                        @csrf
                        <input type="hidden" name="kios_id" value="{{ $kios->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nomor KTP -->
                            <div class="md:col-span-2">
                                <x-input-label for="no_ktp" :value="__('Nomor KTP')" />
                                <x-text-input id="no_ktp" name="no_ktp" type="text"
                                    class="mt-1 block w-full" 
                                    placeholder="Masukkan 16 digit nomor KTP"
                                    maxlength="16"
                                    required />
                                <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
                            </div>
                            <!-- Nomor Telepon -->
                            <div class="md:col-span-2">
                                <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
                                <x-text-input id="no_telp" name="no_telp" type="tel"
                                    class="mt-1 block w-full" 
                                    placeholder="Masukkan nomor telepon"
                                    required />
                                <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                            </div>

                            <!-- Tanggal Mulai Sewa -->
                            <div>
                                <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai Sewa')" />
                                <x-text-input id="tanggal_mulai" name="tanggal_mulai" type="date"
                                    class="mt-1 block w-full" 
                                    min="{{ $min_date }}" 
                                    max="{{ $max_date }}"
                                    required />
                                <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                            </div>

                            <!-- Durasi Sewa -->
                            <div>
                                <x-input-label for="durasi" :value="__('Durasi Sewa (bulan)')" />
                                <x-text-input id="durasi" name="durasi" type="number"
                                    class="mt-1 block w-full" 
                                    min="1" max="12" 
                                    required />
                                <x-input-error :messages="$errors->get('durasi')" class="mt-2" />
                            </div>

                            <!-- Tanggal Selesai (auto-calculated) -->
                            <div>
                                <x-input-label :value="__('Tanggal Selesai Sewa')" />
                                <x-text-input id="tanggal_selesai" type="date"
                                    class="mt-1 block w-full bg-gray-100" 
                                    readonly />
                            </div>

                            <!-- Total Pembayaran (auto-calculated) -->
                            <div>
                                <x-input-label :value="__('Total Pembayaran')" />
                                <x-text-input id="total_pembayaran" type="text"
                                    class="mt-1 block w-full bg-gray-100 font-medium" 
                                    value="Rp 0"
                                    readonly />
                            </div>

                            <!-- Catatan -->
                            <div class="md:col-span-2">
                                <x-input-label for="catatan" :value="__('Catatan (Opsional)')" />
                                <textarea id="catatan" name="catatan" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 gap-4">
                            <a href="{{ url()->previous() }}" 
                               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Ajukan Sewa') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaSewa = {{ $kios->harga_sewa }};
            const durasiInput = document.getElementById('durasi');
            const tglMulaiInput = document.getElementById('tanggal_mulai');
            const tglSelesaiInput = document.getElementById('tanggal_selesai');
            const totalDisplay = document.getElementById('total_pembayaran');
            
            // Fungsi untuk menghitung total dan tanggal selesai
            function calculateValues() {
                const durasi = parseInt(durasiInput.value) || 0;
                const tglMulai = tglMulaiInput.value;
                
                // Hitung total pembayaran
                const total = hargaSewa * durasi;
                totalDisplay.value = 'Rp ' + total.toLocaleString('id-ID');
                
                // Hitung tanggal selesai jika ada tanggal mulai
                if (tglMulai) {
                    const tglMulaiDate = new Date(tglMulai);
                    tglMulaiDate.setMonth(tglMulaiDate.getMonth() + durasi);
                    
                    const year = tglMulaiDate.getFullYear();
                    const month = String(tglMulaiDate.getMonth() + 1).padStart(2, '0');
                    const day = String(tglMulaiDate.getDate()).padStart(2, '0');
                    
                    tglSelesaiInput.value = `${year}-${month}-${day}`;
                }
            }
            
            // Event listeners
            durasiInput.addEventListener('input', calculateValues);
            tglMulaiInput.addEventListener('change', calculateValues);
            
            // Hitung awal jika ada nilai default
            calculateValues();
        });
    </script>
</x-app-layout>