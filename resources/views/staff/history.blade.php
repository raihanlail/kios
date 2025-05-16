<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Data Riwayat Pengajuan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold mb-6 px-8 pt-6">Riwayat Data Pengajuan Pembayaran</h2>
                
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200 text-xs">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Sewa</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pedagang</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasar</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kios</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pembayaran</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sewa</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($pembayaran as $item)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa_id }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->name }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->email }}</td>
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
                                </tr>
                                
                                <!-- Modal Tolak -->
                                <x-modal name="rejectModal{{ $item->id }}" :show="false">
                                    <form action="{{ route('staff.pembayaran.reject', $item) }}" method="POST">
                                        @csrf
                                        <div class="p-4">
                                            <h2 class="text-base font-semibold text-gray-900">
                                                Alasan Penolakan
                                            </h2>

                                            <div class="mt-4">
                                                <textarea 
                                                    name="catatan"
                                                    rows="3"
                                                    class="w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                    required
                                                ></textarea>
                                            </div>

                                            <div class="mt-4 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')" class="text-xs">
                                                    Cancel
                                                </x-secondary-button>

                                                <x-primary-button class="ml-3 bg-red-500 hover:bg-red-600 text-xs">
                                                    Submit Penolakan
                                                </x-primary-button>
                                            </div>
                                        </div>
                                    </form>
                                </x-modal>
                                @endforeach
                            </tbody>
                        </table>
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
