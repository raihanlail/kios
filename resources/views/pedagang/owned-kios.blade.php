<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Kios Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-yellow-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($sewa->isEmpty())
                        <p class="text-gray-500 text-center">Anda belum memiliki kios yang disewa.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($sewa as $item)
                                <div class="group relative overflow-hidden border rounded-lg shadow-lg transition-transform duration-300 hover:scale-105 hover:shadow-xl min-h-[350px]">
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" 
                                         style="background-image: url('{{ Storage::url($item->kios->image) }}')">
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent"></div>
                                    <div class="relative h-full p-6 flex flex-col justify-end space-y-3">
                                        <h3 class="text-2xl font-bold text-white">{{ $item->kios->nama_kios }}</h3>
                                        <div class="space-y-2">
                                            <div class="flex items-center text-gray-200">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                                </svg>
                                                <span>{{ $item->kios->pasar->nama_pasar }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-200">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>{{ $item->kios->lokasi }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-200">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>{{ $item->tanggal_mulai->format('d-m-Y') }} - {{ $item->tanggal_selesai->format('d-m-Y') }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-200">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->diffInDays(\Carbon\Carbon::parse($item->tanggal_mulai)) }} hari</span>
                                            </div>
                                            <div class="flex items-center text-gray-200">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="font-semibold {{ $item->pembayaran->status === 'PAID' ? 'text-green-400' : 'text-yellow-400' }}">
                                                    {{ $item->pembayaran->status }}
                                                </span>
                                            </div>
                                            <div class="flex items-center text-gray-200">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="font-semibold">Rp {{ number_format($item->pembayaran->jumlah, 0, ',', '.') }}</span>
                                            </div>
                                            @if($item->tanggal_selesai->isToday())
            <div class="text-yellow-700 font-medium mb-2">
                ⚠️ Kontrak Anda berakhir hari ini. Status kembali menjadi pending.
            </div>
        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
