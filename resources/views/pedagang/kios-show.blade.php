<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            Detail Kios: {{ $kios->nama_kios }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-yellow-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Bagian Gambar -->
                        <div class="w-full md:w-1/2">
                            @if($kios->image)
                                <img src="{{ Storage::url($kios->image) }}" 
                                     alt="Kios {{ $kios->nama_kios }}"
                                     class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            @if($kios->description)
                            <div class="mt-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi Kios</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $kios->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Bagian Informasi -->
                        <div class="w-full md:w-1/2">
                            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $kios->nama_kios }}</h1>
                            
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Pasar</h3>
                                    <p class="mt-1 text-lg text-gray-800">{{ $kios->pasar->nama_pasar }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                                    <p class="mt-1 text-base text-gray-800">{{ $kios->pasar->alamat }}</p>
                                </div>
                                
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Harga Sewa</h3>
                                    <p class="mt-1 text-lg font-semibold text-blue-600">
                                        Rp {{ number_format($kios->harga_sewa, 0, ',', '.') }} / bulan
                                    </p>
                                </div>
                                
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Lokasi</h3>
                                    <p class="mt-1 text-gray-800">{{ $kios->lokasi }}</p>
                                </div>
                                
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Ukuran</h3>
                                    <p class="mt-1 text-gray-800">{{ $kios->ukuran }} m²</p>
                                </div>
                                
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Status</h3>
                                    <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $kios->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $kios->status == 'available' ? 'Tersedia' : 'Terisi' }}
                                    </span>
                                </div>
                                
                                @if($kios->status == 'available')
                                <div class="pt-4">
                                     <a href="{{ route('sewa.create', $kios->id) }}" 
       class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
                           class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>