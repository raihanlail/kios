<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Riwayat Data Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <div class="container mx-auto px-4 ">
              <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Riwayat Data Pengajuan Pembayaran</h2>
                        
                        <a href="{{ route('manager.pembayaran.download') }}" 
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                
                <div class="bg-white rounded-lg shadow-md border-2 border-yellow-500">
                    <div class="p-6 overflow-x-auto"> <!-- Added overflow-x-auto -->
                        <div class="min-w-full inline-block align-middle"> <!-- Added wrapper div -->
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 text-xs">
                                    <thead>
                                        <tr>
                                           
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pedagang</th>
                                            
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasar</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kios</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pembayaran</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sewa</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontrak</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acc Manager</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($pembayaran as $item)
                                        <tr>
                                            
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->name }}</td>
                                            
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->no_telp }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kios->pasar->nama_pasar }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kios->nama_kios }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->durasi }} Bulan</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->status }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->status }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs">
                                                <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                    Lihat Bukti
                                                </a>
                                            </td>
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap">
                                                @if($item->sewa->status == 'approved' && $item->sewa->kontrak) 
                                                    <a href="{{ route('manager.kontrak.download', $item->sewa->kontrak) }}" 
                                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"/>
                                                        </svg>
                                                        <span>Download</span>
                                                    </a>
                                                @else
                                                    <div>
                                                        <p>Belum Terverifikasi</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kontrak->manager_acc }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-4">
                            {{ $pembayaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
