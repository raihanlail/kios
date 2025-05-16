<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Data Kios') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button onclick="document.getElementById('alert-success').remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    </div>
@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enhanced Filter Section -->
            <div class="border-2 border-yellow-500 overflow-hidden  sm:rounded-md mb-8 p-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="w-full sm:w-64">
                        <label for="pasar-filter" class="block text-sm font-medium text-gray-900 mb-2">Filter Berdasarkan Pasar</label>
                        <select id="pasar-filter" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <option value="">Semua Pasar</option>
                            @foreach($pasars as $pasar)
                                <option value="{{ $pasar->id }}" 
                                    {{ isset($selected_pasar) && $selected_pasar == $pasar->id ? 'selected' : '' }}>
                                    {{ $pasar->nama_pasar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white text-sm">
                            Total Kios: {{ $available_kios->count() + $occupied_kios->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white text-sm">Kios Tersedia</p>
                            <h3 class="text-white text-2xl font-bold">{{ $available_kios->count() }}</h3>
                        </div>
                        <div class="p-3 bg-green-400 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white text-sm">Kios Terisi</p>
                            <h3 class="text-white text-2xl font-bold">{{ $occupied_kios->count() }}</h3>
                        </div>
                        <div class="p-3 bg-red-400 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Kios Cards -->
            @foreach(['available' => ['Kios Tersedia', $available_kios, 'green'], 
                     'occupied' => ['Kios Terisi', $occupied_kios, 'red']] as $key => $data)
                <div class="bg-white border-2 border-yellow-500 overflow-hidden shadow-lg sm:rounded-lg mb-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="border-b border-gray-200">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-{{ $data[2] }}-500"></span>
                                {{ $data[0] }}
                            </h3>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($data[1]->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($data[1] as $kios)
                                    <div class="bg-white border rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="h-48 bg-gray-200 overflow-hidden relative">
                                            @if($kios->image)
                                                <img src="{{ Storage::url($kios->image) }}" alt="{{ $kios->nama_kios }}" 
                                                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-6">
                                            <h4 class="font-bold text-xl mb-2">{{ $kios->nama_kios }}</h4>
                                            <p class="text-gray-600 mb-3 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $kios->pasar->nama_pasar }}
                                            </p>
                                            <p class="text-yellow-600 font-bold text-lg mb-4">
                                                Rp {{ number_format($kios->harga_sewa, 0, ',', '.') }}/bulan
                                            </p>
                                            <p class="text-sm text-gray-500">{{ $kios->ukuran }} m²</p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-500">{{ $kios->lokasi }}</span>
                                                
                                                <span class="px-3 py-1 bg-{{ $key == 'available' ? 'green' : 'red' }}-100 text-{{ $key == 'available' ? 'green' : 'red' }}-800 text-sm font-medium rounded-full">
                                                    {{ $key == 'available' ? 'Tersedia' : 'Terisi' }}
                                                </span>
                                            </div>
                                            <a href="{{ route('pedagang.kios.show', $kios->id) }}" 
                                               class="mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                <span>Lihat Detail</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kios {{ $key == 'available' ? 'tersedia' : 'terisi' }}</h3>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('pasar-filter').addEventListener('change', function() {
            const pasarId = this.value;
            let url = "{{ route('pedagang.kios.filter') }}";
            
            if(pasarId) {
                url += '?pasar_id=' + pasarId;
            }
            
            window.location.href = url;
        });
    </script>
</x-app-layout>