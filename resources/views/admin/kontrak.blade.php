<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Data Kontrak') }}
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
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                
                 <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold mb-6 ">Buat Kontrak</h2>
                
                <div class="bg-white border-2 border-yellow-500 rounded-lg shadow-md">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200 text-xs">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pedagang</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasar</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kios</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pembayaran</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($kontrak as $item)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->name }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->email }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->no_telp }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kios->pasar->nama_pasar }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kios->nama_kios }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->durasi }} Bulan</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pembayaran->status }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-xs">
                                        <form action="{{ route('admin.kontrak.approve', $item) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md mr-2 text-xs">Buat Kontrak</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
