<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pengajuan Jadwal Janji') }}
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __("Data Riwayat Pengajuan Sewa") }}
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                         <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pedagang</th>
                                        <th scope="col" class="hidden sm:table-cell px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pasar</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kios</th>
                                        <th scope="col" class="hidden lg:table-cell px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pertemuan</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-3 py-3 lg:px-6 lg:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($jadwalJanjis as $index => $g)
                                        <tr class="hover:bg-gray-50 transition-all duration-200">
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                            <td class="hidden sm:table-cell px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm text-gray-600">{{ $g->sewa->pedagang->name}}</td>
                                            <td class="hidden sm:table-cell px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm text-gray-600">{{ $g->sewa->kios->pasar->nama_pasar}}</td>
                                            <td class="px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                               {{ $g->sewa->kios->nama_kios}}
                                            </td>
                                            <td class="hidden lg:table-cell px-3 py-3 lg:px-6 lg:py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($g->tanggal)->format('d M Y') }}</td>
                                           
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
                                                @elseif($g->status == 'rejected')
                                                    <span class="px-2 py-1 inline-flex items-center rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                             <td class="px-4 py-2 whitespace-nowrap text-xs">
                                        <form action="{{ route('admin.jadwaljanji.approve', $g) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md mr-2 text-xs">Setujui</button>
                                        </form>
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'rejectModal{{ $g->id }}')"
                                            class="px-3 py-1 text-xs">
                                            {{ __('Tolak') }}
                                        </x-danger-button>
                                    </td>

                                    <x-modal name="rejectModal{{ $g->id }}" :show="false">
                                    <form action="{{ route('admin.jadwaljanji.reject', $g) }}" method="POST">
                                        @csrf
                                        <div class="p-4">
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

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-3 py-3 lg:px-6 lg:py-4 text-center text-sm text-gray-500">
                                                Tidak ada data jadwal janji
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
