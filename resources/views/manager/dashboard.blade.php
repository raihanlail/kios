<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Dashboard Manager') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow border border-yellow-200">
                <form action="{{ route('manager.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-1/3">
                        <label for="pasar_id" class="block text-sm font-medium text-gray-700 mb-1">Filter Berdasarkan Pasar</label>
                        <select name="pasar_id" id="pasar_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                            <option value="">Semua Pasar</option>
                            @foreach($pasars as $pasar)
                                <option value="{{ $pasar->id }}" {{ $pasar_id == $pasar->id ? 'selected' : '' }}>
                                    {{ $pasar->nama_pasar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                            Terapkan Filter
                        </button>
                        @if($pasar_id)
                            <a href="{{ route('manager.dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Kios -->
                <a href="{{ route('manager.kios') }}{{ $pasar_id ? '?pasar_id='.$pasar_id : '' }}" class="group">
                    <div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white hover:bg-blue-700 transition h-full">
                        <div class="flex flex-col h-full">
                            <h5 class="text-lg font-semibold">Total Kios</h5>
                            <span class="text-3xl font-bold mt-2">{{ $totalKios }}</span>
                            @if($pasar_id)
                                <div class="mt-auto pt-2 text-sm text-blue-200 group-hover:text-blue-100">
                                    {{ $pasars->find($pasar_id)->nama_pasar }}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
                
                <!-- Kios Terjual -->
                <a href="{{ route('manager.kios.occupied') }}{{ $pasar_id ? '?pasar_id='.$pasar_id : '' }}" class="group">
                    <div class="bg-green-600 rounded-lg shadow-lg p-6 text-white hover:bg-green-700 transition h-full">
                        <div class="flex flex-col h-full">
                            <h5 class="text-lg font-semibold">Kios Terjual</h5>
                            <span class="text-3xl font-bold mt-2">{{ $kiosTerjual }}</span>
                            @if($pasar_id)
                                <div class="mt-auto pt-2 text-sm text-green-200 group-hover:text-green-100">
                                    {{ $pasars->find($pasar_id)->nama_pasar }}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>

                <!-- Kios Tersedia -->
                <a href="{{ route('manager.kios.available') }}{{ $pasar_id ? '?pasar_id='.$pasar_id : '' }}" class="group">
                    <div class="bg-cyan-600 rounded-lg shadow-lg p-6 text-white hover:bg-cyan-700 transition h-full">
                        <div class="flex flex-col h-full">
                            <h5 class="text-lg font-semibold">Kios Tersedia</h5>
                            <span class="text-3xl font-bold mt-2">{{ $kiosTersedia }}</span>
                            @if($pasar_id)
                                <div class="mt-auto pt-2 text-sm text-cyan-200 group-hover:text-cyan-100">
                                    {{ $pasars->find($pasar_id)->nama_pasar }}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>

                <!-- Total Pendapatan -->
                <div class="bg-yellow-500 rounded-lg shadow-lg p-6 text-gray-900 hover:bg-yellow-600 hover:text-white transition h-full">
                    <div class="flex flex-col h-full">
                        <h5 class="text-lg font-semibold">Total Pendapatan</h5>
                        <span class="text-3xl font-bold mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                        @if($pasar_id)
                            <div class="mt-auto pt-2 text-sm text-yellow-700 hover:text-yellow-100">
                                {{ $pasars->find($pasar_id)->nama_pasar }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info Filter Aktif -->
            @if($pasar_id)
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-700">
                    Menampilkan data untuk pasar: <strong>{{ $pasars->find($pasar_id)->nama_pasar }}</strong>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>