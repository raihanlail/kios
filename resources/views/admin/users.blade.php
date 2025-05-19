<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-600 leading-tight">
            {{ __('Kelola Data User') }}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Tombol Tambah Kios -->
                    <div class="flex flex-row gap-6">

                        <x-primary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'tambahUserModal')">
                            {{ __('Tambah User') }}
                        </x-primary-button>
    
                        
                    </div>

                    <!-- Tabel Data User -->
                    <div class="relative overflow-x-auto pt-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Daftar User</h2>
       
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $index => $g)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                       
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $g->email }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $g->role }}</td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <x-secondary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'editUserModal')"
                                                @click="
                                                    $dispatch('set-user-data', {
                                                        id: '{{ $g->id }}',
                                                        name: '{{ $g->name }}',
                                                        email: '{{ $g->email }}',
                                                        role: '{{ $g->role }}'
                                                    })
                                                "
                                                class="text-blue-600 hover:text-blue-900">{{ __('Edit') }}</x-secondary-button>
                                                  
                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'deleteUserModal'); $dispatch('set-user-data', {
        id: '{{ $g->id }}',
        nama: '{{ $g->name }}'
    })">
                                                {{ __('Delete') }}
                                            </x-danger-button></td>
                       
                       
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center py-8">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-2 text-gray-600">Tidak ada data User</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
         <div class="mt-4">
            {{ $users->links() }}
        </div>
        
    </div>

    
</div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <x-modal name="tambahUserModal" focusable>
        <div class="p-6 bg-white rounded-lg shadow-xl border border-gray-700 max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">{{ __('Tambah User Baru') }}</h2>
                <button x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <x-input-label for="name" value="{{ __('Nama') }}" />
                        <x-text-input id="name" name="name" type="text" 
                            class="mt-1 block w-full" 
                            required
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <x-input-label for="email" value="{{ __('Email') }}" />
                        <x-text-input id="email" name="email" type="email" 
                            class="mt-1 block w-full" 
                            required
                            autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <x-input-label for="role" value="{{ __('Role') }}" />
                        <select name="role" id="role" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="pedagang">Pedagang</option>
                            <option value="staff">Staff</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <x-input-label for="password" value="{{ __('Password') }}" />
                        <x-text-input id="password" name="password" type="password" 
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" 
                            class="mt-1 block w-full"
                            required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end pt-6 border-t border-gray-200 gap-3">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="editUserModal" focusable>
        <div class="p-6 bg-white rounded-lg shadow-xl border border-gray-700 max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">{{ __('Edit Data User') }}</h2>
                <button x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form x-data="{ userData: {} }" @set-user-data.window="userData = $event.detail"
                x-bind:action="'/admin/users/' + userData.id" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <x-input-label for="edit_name" value="{{ __('Nama') }}" />
                        <x-text-input id="edit_name" name="name" type="text" 
                            class="mt-1 block w-full"
                            x-bind:value="userData.name" 
                            required />
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <x-input-label for="edit_email" value="{{ __('Email') }}" />
                        <x-text-input id="edit_email" name="email" type="email" 
                            class="mt-1 block w-full"
                            x-bind:value="userData.email"
                            required />
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <x-input-label for="edit_role" value="{{ __('Role') }}" />
                        <select name="role" id="edit_role" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="admin" x-bind:selected="userData.role === 'admin'">Admin</option>
                            <option value="manager" x-bind:selected="userData.role === 'manager'">Manager</option>
                            <option value="pedagang" x-bind:selected="userData.role === 'pedagang'">Pedagang</option>
                            <option value="staff" x-bind:selected="userData.role === 'staff'">Staff</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <x-input-label for="edit_password" value="{{ __('Password Baru (opsional)') }}" />
                        <x-text-input id="edit_password" name="password" type="password" 
                            class="mt-1 block w-full" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end pt-6 border-t border-gray-200 gap-3">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

     <x-modal name="deleteUserModal" focusable>
         <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal Header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Konfirmasi Hapus
                    </h3>
                </div>
                <div class="p-4">
                    <form x-data="{ userData: {} }" @set-user-data.window="userData = $event.detail"
                        x-bind:action="'/admin/users/' + userData.id" method="POST" class="space-y-4">
                        @csrf
                        @method('DELETE')
                        <p class="text-gray-600">Yakin menghapus user <span x-text="userData.nama"
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
