<x-app-layout>
    

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl text-yellow-600 font-bold mb-6">Verifikasi Kontrak</h2>
                    
                    <div class="bg-white border-2 border-yellow-500 rounded-lg shadow-md">
                        <div class="p-4">
                            <!-- Search Results -->
                            @if(request('search'))
                            <div class="mb-4 text-sm text-gray-600">
                                Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                                <a href="{{ route('admin.kontrak.history') }}" class="text-blue-600 ml-2">(Reset)</a>
                            </div>
                            @endif

                            <!-- Table Container with Horizontal Scroll -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pedagang</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasar</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kios</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pembayaran</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sewa</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Kontrak</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($kontrak as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->pedagang->name }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->pedagang->email }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->no_telp }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->kios->pasar->nama_pasar }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->kios->nama_kios }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->tanggal_mulai }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->tanggal_selesai }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $item->sewa->durasi }} Bulan</td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $item->sewa->pembayaran->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $item->sewa->pembayaran->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $item->sewa->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $item->sewa->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                @if($item->sewa->status == 'approved' && $item->sewa->kontrak)
                                                <a href="{{ route('manager.kontrak.download', $item->sewa->kontrak) }}" 
                                                   class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"/>
                                                    </svg>
                                                    Download
                                                </a>
                                                @else
                                                <span class="text-sm text-gray-500">Belum Terverifikasi</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <form action="{{ route('manager.kontrak.approve', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm transition-colors duration-200">
                                                        Setujui Kontrak
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6">
                                {{ $kontrak->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
