<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Data Riwayat Pengajuan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-9xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="container mx-auto p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Riwayat Data Pengajuan Pembayaran</h2>
                        
                        <a href="{{ route('staff.pembayaran.download') }}" 
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                    
                    <div class="border border-yellow-400 rounded-lg shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID Sewa</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pedagang</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No Telepon</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pasar</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kios</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Durasi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Pembayaran</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Sewa</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bukti</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pembayaran as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa_id }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->pedagang->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->pedagang->email }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->no_telp }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->kios->pasar->nama_pasar }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->kios->nama_kios }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->durasi }} Bulan</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->status }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->sewa->status }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                                            <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" 
                                               target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 font-medium">
                                                Lihat Bukti
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <x-modal name="rejectModal{{ $item->id }}" :show="false">
                                        <form action="{{ route('staff.pembayaran.reject', $item) }}" method="POST" class="p-6">
                                            @csrf
                                            <h2 class="text-lg font-medium text-gray-900 mb-4">
                                                Alasan Penolakan
                                            </h2>

                                            <textarea 
                                                name="catatan"
                                                rows="3"
                                                class="w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                                                required
                                            ></textarea>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    Batal
                                                </x-secondary-button>
                                                <x-primary-button class="bg-red-500 hover:bg-red-600">
                                                    Konfirmasi Penolakan
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t">
                            {{ $pembayaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
