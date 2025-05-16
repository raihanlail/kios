<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Riwayat Pengajuan Penyewaan') }}
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
            <div class="bg-white  overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 ">
                    <h3 class="text-lg font-medium text-gray-900 ">
                        {{ __("Data Riwayat Pengajuan Sewa") }}
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                        <th scope="col" class="hidden sm:table-cell px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pasar</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kios</th>
                                        <th scope="col" class="hidden lg:table-cell px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Mulai</th>
                                        <th scope="col" class="hidden lg:table-cell px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Selesai</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pembayaran</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kontrak</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jadwal Janji</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($sewa as $index => $g)
                                        <tr class="hover:bg-gray-50 transition-all duration-200">
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                            <td class="hidden sm:table-cell px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm text-gray-600">{{ $g->kios->pasar->nama_pasar}}</td>
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <div>{{ $g->kios->nama_kios }}</div>
                                                <div class="sm:hidden text-xs text-gray-500">{{ $g->kios->pasar->nama_pasar}}</div>
                                                <div class="lg:hidden text-xs text-gray-500">{{ \Carbon\Carbon::parse($g->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($g->tanggal_selesai)->format('d/m/Y') }}</div>
                                            </td>
                                            <td class="hidden lg:table-cell px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($g->tanggal_mulai)->format('d M Y') }}</td>
                                            <td class="hidden lg:table-cell px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($g->tanggal_selesai)->format('d M Y') }}</td>
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap">
                                                @if($g->status == 'pending')
                                                    <span class="px-2 py-1 inline-flex items-center rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                                        </svg>
                                                        Pending
                                                    </span>
                                                @elseif($g->status == 'approved')
                                                    <span class="px-2 py-1 inline-flex items-center rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Terverifikasi
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap">
                                                @if($g->status == 'approved' && $g->kontrak)
                                                    <span class="px-2 py-1 inline-flex items-center text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                        </svg>
                                                        Lunas
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap">
                                                @if($g->status == 'approved' && $g->kontrak)
                                                    <a href="{{ route('kontrak.download', $g->kontrak) }}" 
                                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"/>
                                                        </svg>
                                                        <span>Download</span>
                                                    </a>
                                                @endif
                                            </td>
                                             <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap">
                                                @if($g->status == 'approved')
                                                    <button x-data="" x-on:click="$dispatch('open-modal', 'create-jadwal-{{ $g->id }}')"
                                                        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        Buat Jadwal
                                                    </button>

                                                    <x-modal name="create-jadwal-{{ $g->id }}" focusable>
                                                        <form method="POST" action="{{ route('pedagang.jadwaljanji.store') }}" class="p-6">
                                                            @csrf
                                                            <input type="hidden" name="sewa_id" value="{{ $g->id }}">
                                                            
                                                            <h2 class="text-lg font-medium text-gray-900">
                                                                Buat Jadwal Janji
                                                            </h2>
                                                            <div class="mt-2 max-w-3/4">

                                                                <p class="text-base font-medium text-gray-900 pr-48">
                                                                    Silakan pilih tanggal untuk membuat jadwal janji untuk penyerahan kunci kios. 
    
                                                                </p>
                                                                <p class="text-base font-medium text-gray-900 pr-48">
                                                                   mohon sertakan file kontrak yang sudah diunduh saat pertemuan.
    
                                                                </p>
                                                            </div>

                                                            <div class="mt-6">
                                                               <label for="tanggal" class="block text-sm font-medium text-gray-700">
                                                                    Tanggal
                                                                <input id="tanggal" type="date" name="tanggal" class="mt-1 block w-full" required />
                                                            </div>

                                                            <div class="mt-6 flex justify-end">
                                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                                    Batal
                                                                </x-secondary-button>

                                                                <x-primary-button class="ml-3">
                                                                    Buat Jadwal
                                                                </x-primary-button>
                                                            </div>
                                                        </form>
                                                    </x-modal>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-3 py-8 lg:px-6 lg:py-12">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                    </svg>
                                                    <p class="mt-4 text-base lg:text-lg font-medium text-gray-500">Belum ada data sewa</p>
                                                    <p class="mt-1 text-xs lg:text-sm text-gray-400">Data sewa akan muncul di sini setelah Anda melakukan pengajuan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
