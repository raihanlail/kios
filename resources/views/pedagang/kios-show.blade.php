<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            Detail Kios: {{ $kios->nama_kios }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-yellow-500 overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-8 bg-white">
                    <div class="flex flex-col lg:flex-row gap-12">
                        <!-- Bagian Gambar -->
                        <div class="w-full lg:w-1/2">
                            @if($kios->image)
                                <div class="relative group">
                                    <img src="{{ Storage::url($kios->image) }}" 
                                         alt="Kios {{ $kios->nama_kios }}"
                                         class="w-full h-72 rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-300 rounded-xl"></div>
                                </div>
                            @else
                                <div class="w-full h-80 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            @if($kios->description)
                            <div class="mt-6">
                                <h3 class="text-base font-semibold text-gray-600 mb-3">Deskripsi Kios</h3>
                                <div class="bg-gray-50 rounded-xl p-5 shadow-inner">
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $kios->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Bagian Informasi -->
                        <div class="w-full lg:w-1/2">
                           
                            
                            <div class="space-y-6">
                                
                                <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
                                     <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $kios->nama_kios }}</h1>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500">Pasar</h3>
                                            <p class="mt-2 text-lg font-medium text-gray-800">{{ $kios->pasar->nama_pasar }}</p>
                                        </div>
                                        
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500">Status</h3>
                                            <span class="mt-2 inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold 
                                                {{ $kios->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $kios->status == 'available' ? 'Tersedia' : 'Terisi' }}
                                            </span>
                                        </div>

                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500">Harga Sewa</h3>
                                            <p class="mt-2 text-xl font-bold text-yellow-600">
                                                Rp {{ number_format($kios->harga_sewa, 0, ',', '.') }}
                                                <span class="text-sm font-normal text-gray-500">/bulan</span>
                                            </p>
                                        </div>

                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500">Ukuran</h3>
                                            <p class="mt-2 text-lg font-medium text-gray-800">{{ $kios->ukuran }} m²</p>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                                        <p class="mt-2 text-base text-gray-800">{{ $kios->pasar->alamat }}</p>
                                    </div>

                                    <div class="mt-6">
                                        <h3 class="text-sm font-medium text-gray-500">Lokasi di Pasar</h3>
                                        <p class="mt-2 text-base text-gray-800">{{ $kios->lokasi }}</p>
                                    </div>
                                </div>
                                
                                @if($kios->status == 'available')
                                <div class="pt-4">
                                    <a href="{{ route('sewa.create', $kios->id) }}" 
                                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-yellow-600 border border-transparent rounded-xl font-semibold text-white text-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Sewa Kios Ini
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol Kembali -->
                    <div class="mt-8">
                        <a href="{{ url()->previous() }}" 
                           class="text-gray-600 hover:text-yellow-600 inline-flex items-center transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke halaman sebelumnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>