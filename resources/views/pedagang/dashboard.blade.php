<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Perumda Pasar Pakuan Jaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-yellow-500  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 ">
                    <h2 class="text-2xl font-bold text-yellow-600 ">
                        {{ __("Daftar Pasar Tersedia") }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 ">
                        Halo, {{ Auth::user()->name}}! Pilih pasar untuk melihat kios yang tersedia
                    </p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
                    @foreach ($pasars as $pasar)
                        <div class="bg-white  rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-900 ">
                                    Unit {{ $pasar->nama_pasar }}
                                </h3>
                                <p class="mt-2 text-gray-600 text-sm ">
                                    {{ $pasar->alamat }}
                                </p>
                                <div class="mt-4">
                                    <a href="/pedagang/kios/filter?pasar_id={{ $pasar->id }}" 
                                       class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-500 text-white text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                                        Lihat Kios
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
