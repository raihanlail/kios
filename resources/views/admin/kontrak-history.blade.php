<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Data Kontrak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[88rem] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                 <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold mb-6 px-8 pt-6">Riwayat Kontrak</h2>
                
               <div class="bg-white border-2 border-yellow-500 rounded-lg shadow-md">
    <div class="p-6">
        <!-- Tambahkan form search di sini -->
        
        @if(request('search'))
        <div class="mb-4 text-xs text-gray-600">
            Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
            <a href="{{ route('admin.kontrak.history') }}" class="text-blue-600 ml-2">(Reset)</a>
        </div>
        @endif

        <table class="min-w-full divide-y divide-gray-200 text-xs">
            <!-- Header tabel tetap sama -->
            <thead>
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
                </tr>
            </thead>
            <!-- Isi tabel tetap sama -->
            <tbody class="divide-y divide-gray-200">
                @foreach($kontrak as $item)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->pedagang->email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->no_telp }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kios->pasar->nama_pasar }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->kios->nama_kios }}</td>
                     <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->tanggal_mulai }}</td>
                      <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->tanggal_selesai }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">{{ $item->sewa->durasi }} Bulan</td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $item->sewa->pembayaran->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $item->sewa->pembayaran->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $item->sewa->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $item->sewa->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $kontrak->links() }}
        </div>
    </div>
</div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
