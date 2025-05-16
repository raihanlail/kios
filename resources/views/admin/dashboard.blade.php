<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600  leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8">
            <!-- Kios Stats Section -->
            <div class="mb-6">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 ">
                        <div class="p-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 ">
                                {{ __("Data Kios Overview") }}
                            </h3>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-6">
                        <a href="{{route('admin.kios')}}" class="block">
                            <div class="bg-gradient-to-tr from-blue-600 to-blue-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Kios Tersedia</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$count_available}}</h4>
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

                        <a href="{{route('admin.kios')}}" class="block">
                            <div class="bg-gradient-to-tr from-red-600 to-red-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Kios Terisi</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$count_occupied}}</h4>
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
                    </div>
                </div>
            </div>

            <!-- Kontrak Stats Section -->
            <div>
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 ">
                        <div class="p-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 ">
                                {{ __("Status Kontrak") }}
                            </h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-6">
                        <a href="{{route('admin.kontrak')}}" class="block">
                            <div class="bg-gradient-to-tr from-yellow-600 to-yellow-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Kontrak Pending</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$pending_contracts}}</h4>
                                    </div>
                                    <div class="p-3 bg-yellow-400 bg-opacity-30 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm opacity-80">
                                    Click to review pending contracts
                                </div>
                            </div>
                        </a>

                        <a href="{{route('admin.kontrak.history')}}" class="block">
                            <div class="bg-gradient-to-tr from-green-600 to-green-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Kontrak Disetujui</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$accepted_contracts}}</h4>
                                    </div>
                                    <div class="p-3 bg-green-400 bg-opacity-30 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm opacity-80">
                                    Click to view approved contracts
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 ">
                        <div class="p-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 ">
                                {{ __("Jadwal Janji") }}
                            </h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-6">
                        <a href="{{route('admin.jadwaljanji.index')}}" class="block">
                            <div class="bg-gradient-to-tr from-yellow-600 to-yellow-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Pengajuan Jadwal Pending</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$pending_jadwal}}</h4>
                                    </div>
                                    <div class="p-3 bg-yellow-400 bg-opacity-30 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm opacity-80">
                                    Click to review pending contracts
                                </div>
                            </div>
                        </a>

                        <a href="{{route('admin.jadwaljanji.history')}}" class="block">
                            <div class="bg-gradient-to-tr from-green-600 to-green-400 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm opacity-80">Jadwal janji Disetujui</p>
                                        <h4 class="text-4xl font-bold mt-1">{{$accepted_jadwal}}</h4>
                                    </div>
                                    <div class="p-3 bg-green-400 bg-opacity-30 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm opacity-80">
                                    Click to view approved contracts
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
