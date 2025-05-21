<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Kelola Data Kios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                   

                    <!-- Tabel Data Kios -->
                    <div class="relative overflow-x-auto pt-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Semua Kios</h2>
       
    </div>

  <div class="mb-4 bg-white p-4 rounded-lg shadow">
    <form action="{{ route('manager.kios') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="w-full md:w-1/3">
            <label for="pasar_id" class="block text-sm font-medium text-gray-700 mb-1">Filter Berdasarkan Pasar</label>
            <select name="pasar_id" id="pasar_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                <option value="">Semua Pasar</option>
                @foreach($pasars as $pasar)
                    <option value="{{ $pasar->id }}" {{ $selected_pasar == $pasar->id ? 'selected' : '' }}>
                        {{ $pasar->nama_pasar }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2 w-full md:w-auto">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                Terapkan Filter
            </button>
            @if($selected_pasar)
                <a href="{{ route('manager.kios') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <!-- Info Filter Aktif -->
    @if($selected_pasar)
        <div class="p-4 bg-yellow-50 border-b border-yellow-200 text-sm text-yellow-700">
            Menampilkan kios di pasar: <strong>{{ $pasars->find($selected_pasar)->nama_pasar }}</strong>
        </div>
    @endif

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasar</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kios</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Sewa</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ukuran</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($kios as $index => $g)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ ($kios->currentPage()-1) * $kios->perPage() + $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($g->image)
                            <div class="flex items-center justify-center">
                                <img class="h-16 w-16 rounded-md object-cover" 
                                     src="{{ Storage::url($g->image) }}" 
                                     alt="Foto Kios {{ $g->nama_kios }}">
                            </div>
                        @else
                            <div class="flex items-center justify-center">
                                <div class="h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->pasar->nama_pasar }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $g->nama_kios }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        Rp {{ number_format($g->harga_sewa, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->lokasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->ukuran }} m²</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $g->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $g->status == 'available' ? 'Tersedia' : 'Terisi' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                        <div class="flex flex-col items-center justify-center py-8">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="mt-2 text-gray-600">Tidak ada data kios ditemukan</p>
                            @if($selected_pasar)
                                <a href="{{ route('manager.kios') }}" class="mt-2 text-yellow-600 hover:text-yellow-800 text-sm">
                                    Reset filter
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $kios->appends(['pasar_id' => $selected_pasar])->links() }}
    </div>
</div>

    
</div>
            </div>
        </div>
    </div>

    
   

    

   
    

   
</x-app-layout>
