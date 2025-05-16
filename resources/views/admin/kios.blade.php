<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Kelola Data Kios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Tombol Tambah Kios -->
                    <div class="flex flex-row gap-6">

                        <x-primary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'tambahKiosModal')">
                            {{ __('Tambah Kios') }}
                        </x-primary-button>
    
                        
                    </div>

                    <!-- Tabel Data Siswa -->
                    <div class="relative overflow-x-auto pt-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Kios</h2>
       
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kios</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Sewa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ukuran</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($kios as $index => $g)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($g->image)
                                <div class="flex items-center justify-center">
                                    <img class="h-16 w-16 rounded-md object-cover" 
                                         src="{{ Storage::url($g->image) }}" 
                                         alt="Foto Kios {{ $g->nama_kios }}"
                                        >
                                </div>
                            @else
                                <div class="flex items-center justify-center">
                                    <div class="h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->pasar->nama_pasar }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $g->nama_kios }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{$g->harga_sewa}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->lokasi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->ukuran }} m²</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $g->status == 'available' ? 'bg-green-500 text-green-800' : 'bg-yellow-500 text-yellow-800' }}">
                                {{ $g->status == 'available' ? 'Tersedia' : 'Terisi' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-secondary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'editKiosModal')"
                                                @click="
                                                    $dispatch('set-kios-data', {
                                                        id: '{{ $g->id }}',
                                                        nama_kios: '{{ $g->nama_kios }}',
                                                        pasar_id: '{{ $g->pasar->nama_pasar }}',
                                                        harga_sewa: '{{ $g->harga_sewa }}',
                                                        lokasi: '{{ $g->lokasi }}',
                                                        description: '{{ $g->description }}',
                                                        ukuran: '{{ $g->ukuran }}',
                                                        status: '{{ $g->status }}',
                                                        image: '{{ $g->image ? Storage::url($g->image) : '' }}'
                                                    })
                                                "
                                                class="text-blue-600 hover:text-blue-900">{{ __('Edit') }}</x-secondary-button>
                                                  <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'deleteKiosModal'); $dispatch('set-kios-data', {
        id: '{{ $g->id }}',
        nama: '{{ $g->nama_kios }}'
    })">
                                                {{ __('Delete') }}
                                            </x-danger-button>

                        </td>
                       
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center py-8">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-2 text-gray-600">Tidak ada data kios ditemukan</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
         <div class="mt-4">
                            {{ $kios->links() }}
                        </div>
    </div>

    
</div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kios -->
    <x-modal name="tambahKiosModal" focusable>
        <div class="p-6 bg-white rounded-lg shadow-xl border border-gray-700 max-w-2xl mx-auto">
            <!-- Previous header code remains the same -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form action="{{ route('admin.kios.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pasar Selection -->
            <div class="space-y-2">
                <x-input-label class="text-gray-300" for="pasar_id" value="{{ __('Nama Pasar') }}" />
                <select name="pasar_id" id="pasar_id" required
                    class="mt-1 block w-full px-3 py-2.5 rounded-md shadow-sm bg-gray-100 border-gray-600 text-gray-900 
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="" disabled selected>Pilih Pasar</option>
                    @foreach ($pasars as $p)
                        <option value="{{ $p->id }}" class="bg-gray-100">{{ $p->nama_pasar }}</option>
                    @endforeach
                </select>
                @error('pasar_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Kios -->
            <div class="space-y-2">
                <x-input-label class="text-gray-300" for="nama_kios" value="{{ __('Nama Kios') }}" />
                <x-text-input id="nama_kios" name="nama_kios" type="text" 
                    class="mt-1 block w-full bg-gray-700 text-gray-300 border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="{{ __('Contoh: Kios A-01') }}" 
                    value="{{ old('nama_kios') }}"
                    maxlength="255"
                    required />
                @error('nama_kios')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
             <div class="space-y-2">
                <x-input-label class="text-gray-300" for="description" value="{{ __('Deskripsi') }}" />
                <x-text-input id="description" name="description" type="text" 
                    class="mt-1 block w-full bg-gray-700 text-gray-300 border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="{{ __('Masukkan Deskripsi') }}" 
                    value="{{ old('description') }}"
                    maxlength="255"
                    required />
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga Sewa -->
            <div class="space-y-2">
                <x-input-label class="text-gray-300" for="harga_sewa" value="{{ __('Harga Sewa') }}" />
                <div class="relative mt-1 rounded-md shadow-sm">
                    
                    <x-text-input id="harga_sewa" name="harga_sewa" type="number" 
                        class="block w-full pl-10 bg-gray-700 text-gray-300 border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="{{ __('Contoh: 1500000') }}" 
                        value="{{ old('harga_sewa') }}"
                        step="any"
                        required />
                </div>
                @error('harga_sewa')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <x-input-label class="text-gray-300" for="status" value="{{ __('Status Kios') }}" />
                <select name="status" id="status" required
                    class="mt-1 block w-full px-3 py-2.5 rounded-md shadow-sm bg-gray-100 border-gray-600 text-gray-900 
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }} class="bg-gray-100">Available</option>
                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }} class="bg-gray-100">Occupied</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ukuran -->
            <div class="space-y-2">
                <x-input-label class="text-gray-300" for="ukuran" value="{{ __('Ukuran') }}" />
                <select name="ukuran" id="ukuran" required
                    class="mt-1 block w-full px-3 py-2.5 rounded-md shadow-sm bg-gray-100 border-gray-600 text-gray-900 
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="" disabled selected>Pilih Ukuran</option>
                    <option value="2x3" class="bg-gray-100">2x3 m²</option>
                    <option value="2x4" class="bg-gray-100">2x4 m²</option>
                    <option value="2x5" class="bg-gray-100">2x5 m²</option>
                    <option value="2x6" class="bg-gray-100">2x6 m²</option>
                    <option value="2x7" class="bg-gray-100">2x7 m²</option>
                    <option value="2x8" class="bg-gray-100">2x8 m²</option>
                </select>
                @error('ukuran')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="space-y-2">
                <x-input-label class="text-gray-300" for="lokasi" value="{{ __('Lokasi') }}" />
                <x-text-input id="lokasi" name="lokasi" type="text" 
                    class="mt-1 block w-full bg-gray-700 text-gray-300 border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="{{ __('Contoh: Lantai 1, Blok A') }}" 
                    value="{{ old('lokasi') }}"
                    maxlength="255"
                    required />
                @error('lokasi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto Kios -->
            <div class="space-y-2 md:col-span-2">
                <x-input-label class="text-gray-300" for="image" value="{{ __('Foto Kios') }}" />
                <div class="mt-1 flex items-center">
                    <label for="image" class="cursor-pointer">
                        <div class="flex flex-col items-center justify-center px-6 py-8 border-2 border-dashed border-gray-600 rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-150 w-full">
                            <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-900">{{ __('Klik untuk upload foto') }}</p>
                            <p class="text-xs text-gray-900 mt-1">{{ __('Format: JPG, PNG (Max 2MB)') }}</p>
                        </div>
                        <input type="file" id="image" name="image" class="hidden" 
                               accept="image/jpeg,image/png,image/jpg,image/gif" />
                    </label>
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <div id="image-preview" class="mt-2 hidden">
                    <img id="preview-image" class="h-32 rounded-md border border-gray-600" src="#" alt="Preview" />
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end pt-6 border-t border-gray-700 gap-3">
            <x-secondary-button type="button" 
                class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 border-gray-600"
                x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>
            <x-primary-button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 focus-visible:outline-blue-600">
                <svg class="w-5 h-5 mr-1 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                {{ __('Simpan Data') }}
            </x-primary-button>
        </div>
    </form>
</div>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.setAttribute('src', e.target.result);
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            previewContainer.classList.add('hidden');
            previewImage.setAttribute('src', '#');
        }
    });
</script>
    </x-modal>

    <x-modal name="editKiosModal" focusable>
        <div class="p-6 bg-gray-100 rounded-lg shadow-xl border border-gray-700 max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">{{ __('Edit Data Kios') }}</h2>
                <button x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form x-data="{ kiosData: {} }" @set-kios-data.window="kiosData = $event.detail"
                x-bind:action="'/admin/kios/' + kiosData.id" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pasar Selection -->
                    <div class="space-y-2">
                        <x-input-label class="text-gray-300" for="edit_pasar_id" value="{{ __('Nama Pasar') }}" />
                        <select name="pasar_id" id="edit_pasar_id" required
                            class="mt-1 block w-full px-3 py-2.5 rounded-md shadow-sm bg-gray-100 border-gray-600 text-gray-900">
                            @foreach ($pasars as $p)
                                <option value="{{ $p->id }}" class="bg-gray-100" x-bind:selected="kiosData.pasar_id == '{{ $p->nama_pasar }}'">
                                    {{ $p->nama_pasar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Kios -->
                    <div class="space-y-2">
                        <x-input-label class="text-gray-900" for="edit_nama_kios" value="{{ __('Nama Kios') }}" />
                        <x-text-input id="edit_nama_kios" name="nama_kios" type="text" 
                            class="mt-1 block w-full bg-gray-100 text-gray-900 border-gray-600"
                            x-bind:value="kiosData.nama_kios" required />
                    </div>
                     <div class="space-y-2">
                        <x-input-label class="text-gray-900" for="edit_description" value="{{ __('Deskripsi') }}" />
                        <x-text-input id="edit_description name="description" type="text" 
                            class="mt-1 block w-full bg-gray-100 text-gray-900 border-gray-600"
                            x-bind:value="kiosData.description" required />
                    </div>

                    <!-- Harga Sewa -->
                    <div class="space-y-2">
                        <x-input-label class="text-gray-900" for="edit_harga_sewa" value="{{ __('Harga Sewa') }}" />
                        <x-text-input id="edit_harga_sewa" name="harga_sewa" type="number" 
                            class="mt-1 block w-full bg-gray-100 text-gray-900 border-gray-600"
                            x-bind:value="kiosData.harga_sewa" required />
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <x-input-label class="text-gray-900" for="edit_status" value="{{ __('Status') }}" />
                        <select name="status" id="edit_status" required
                            class="mt-1 block w-full px-3 py-2.5 rounded-md shadow-sm bg-gray-100 border-gray-600 text-gray-900">
                            <option value="available" class="bg-gray-100" x-bind:selected="kiosData.status === 'available'">Available</option>
                            <option value="occupied" class="bg-gray-100" x-bind:selected="kiosData.status === 'occupied'">Occupied</option>
                        </select>
                    </div>

                    <!-- Ukuran -->
                    <div class="space-y-2">
                        <x-input-label class="text-gray-900" for="edit_ukuran" value="{{ __('Ukuran') }}" />
                        <x-text-input id="edit_ukuran" name="ukuran" type="text" 
                            class="mt-1 block w-full bg-gray-100 text-gray-900 border-gray-600"
                            x-bind:value="kiosData.ukuran" required />
                    </div>

                    <!-- Lokasi -->
                    <div class="space-y-2">
                        <x-input-label class="text-gray-900" for="edit_lokasi" value="{{ __('Lokasi') }}" />
                        <x-text-input id="edit_lokasi" name="lokasi" type="text" 
                            class="mt-1 block w-full bg-gray-100 text-gray-900 border-gray-600"
                            x-bind:value="kiosData.lokasi" required />
                    </div>

                    <!-- Foto Kios -->
                    <div class="space-y-2 md:col-span-2">
                        <x-input-label class="text-gray-900" for="edit_image" value="{{ __('Foto Kios') }}" />
                        <input type="file" id="edit_image" name="image" 
                            class="mt-1 block w-full text-gray-300"
                            accept="image/jpeg,image/png,image/jpg" />
                        <div class="mt-2" x-show="kiosData.image">
                            <img x-bind:src="kiosData.image" class="h-32 rounded-md" alt="Current Image">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end pt-6 border-t border-gray-700 gap-3">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-gray-700 text-gray-300">
                        {{ __('Batal') }}
                    </x-secondary-button>
                    <x-primary-button class="px-4 py-2">
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Modal Delete -->
    <x-modal name="deleteKiosModal" focusable>
         <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal Header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Konfirmasi Hapus
                    </h3>
                </div>
                <div class="p-4">
                    <form x-data="{ kiosData: {} }" @set-kios-data.window="kiosData = $event.detail"
                        x-bind:action="'/admin/kios/' + kiosData.id" method="POST" class="space-y-4">
                        @csrf
                        @method('DELETE')
                        <p class="text-gray-600">Yakin menghapus kios <span x-text="kiosData.nama"
                                class="font-semibold"></span>?</p>
                        <div class="flex justify-end gap-2">
                            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                {{ __('Batal') }}
                            </x-secondary-button>
                            <x-danger-button>
                                {{ __('Hapus') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>
    </x-modal>

   
</x-app-layout>
