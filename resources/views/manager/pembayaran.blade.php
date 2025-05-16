<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold mb-6 px-8 pt-6">Riwayat data pemesanan</h2>
                
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
