<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    {{ __("Staff Keuangan Dashboard") }}
                </div>

                  <div class="mb-6">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 ">
                        <div class="p-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 ">
                                {{ __("Data Pembayaran") }}
                            </h3>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-6">
                        <a href="{{route('staff.pembayaran.index')}}" class="block">
                            <div class="bg-gradient-to-tr from-blue-600 to-blue-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Pembayaran Pending</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$pending_pembayaran}}</h4>
                                    </div>
                                    <div class="p-3 bg-blue-400 bg-opacity-30 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm opacity-80">
                                    Click to view details
                                </div>
                            </div>
                        </a>

                        <a href="{{route('staff.pembayaran.history')}}" class="block">
                            <div class="bg-gradient-to-tr from-red-600 to-red-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Pembayaran Terverifikasi</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$verified_pembayaran}}</h4>
                                    </div>
                                    <div class="p-3 bg-red-400 bg-opacity-30 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm opacity-80">
                                    Click to view details
                                </div>
                            </div>
                        </a>
                         <div class="bg-yellow-500 rounded-lg shadow-lg p-6 text-gray-900">
                    <div class="flex flex-col">
                        <h5 class="text-lg font-semibold">Total Pendapatan</h5>
                        <span class="text-3xl font-bold mt-2">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
                    </div>
                </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
