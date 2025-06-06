<nav x-data="{ open: false }" class="bg-white  border-b border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                        </a>
                    @elseif(Auth::user()->role == 'pedagang')
                        <a href="{{ route('pedagang.dashboard') }}">
                            <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                        </a>
                    @elseif(Auth::user()->role == 'staff')
                        <a href="{{ route('staff.dashboard') }}">
                            <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                        </a>
                    @elseif(Auth::user()->role == 'manager')
                        <a href="{{ route('manager.dashboard') }}">
                            <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                  
                    @if(Auth::user()->role == 'admin') 
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kios')" :active="request()->routeIs('admin.kios')">
                            {{ __('Data Kios') }}
                        </x-nav-link>

                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ __('Kontrak') }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.kontrak')">
                                        {{ __('Data Kontrak') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.kontrak.history')">
                                        {{ __('Riwayat Kontrak') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            
                        </div>

                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ __('Jadwal Janji') }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.jadwaljanji.index')">
                                        {{ __('Jadwal Janji') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.jadwaljanji.history')">
                                        {{ __('Riwayat Jadwal Janji') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                         <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                            {{ __('Kelola Data User') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'pedagang') 
                        <x-nav-link :href="route('pedagang.dashboard')" :active="request()->routeIs('pedagang.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ __('Data Kios') }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('pedagang.kios')">
                                        {{ __('Cari Kios') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('pedagang.owned-kios')">
                                        {{ __('Kios Saya') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <x-nav-link :href="route('pedagang.sewa.index')" :active="request()->routeIs('pedagang.sewa.*')">
                            {{ __('Riwayat Sewa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pedagang.jadwaljanji.index')" :active="request()->routeIs('pedagang.jadwaljanji.index')">
                            {{ __('Jadwal janji') }}
                        </x-nav-link>
                  
                    @endif

                    @if(Auth::user()->role == 'staff') 
                       <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('staff.pembayaran.index')" :active="request()->routeIs('staff.pembayaran.index')">
                        {{ __('Data Pembayaran') }}
                    </x-nav-link>
                      <x-nav-link :href="route('staff.pembayaran.history')" :active="request()->routeIs('staff.pembayaran.history')">
                        {{ __('Riwayat Data Pembayaran') }}
                    </x-nav-link>
                   
                  
                    @endif 

                    @if(Auth::user()->role == 'manager') 
                       <x-nav-link :href="route('manager.dashboard')" :active="request()->routeIs('manager.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ __('Data Kios') }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('manager.kios')">
                                    {{ __('Semua Kios') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('manager.kios.available')">
                                    {{ __('Kios Tersedia') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('manager.kios.occupied')">
                                    {{ __('Kios Terisi') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                     <x-nav-link :href="route('manager.kontrak')" :active="request()->routeIs('manager.kontrak')">
                        {{ __('ACC Kontrak') }}
                    </x-nav-link>
                     <x-nav-link :href="route('manager.pembayaran')" :active="request()->routeIs('manager.pembayaran')">
                        {{ __('Data Pembayaran') }}
                    </x-nav-link>
                   
                  
                    @endif 
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  bg-white  hover:text-gray-700  focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400  hover:text-gray-500  transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        @if(Auth::user()->role == 'admin')
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kios')" :active="request()->routeIs('admin.kios')">
                {{ __('Data Kios') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kontrak')" :active="request()->routeIs('admin.kontrak')">
                {{ __('Data Kontrak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kontrak.history')" :active="request()->routeIs('admin.kontrak.history')">
                {{ __('Riwayat Kontrak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.jadwaljanji.index')" :active="request()->routeIs('admin.jadwaljanji.index')">
                {{ __('Jadwal Janji') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.jadwaljanji.history')" :active="request()->routeIs('admin.jadwaljanji.history')">
                {{ __('Riwayat Jadwal Janji') }}
            </x-responsive-nav-link>
        @endif

        @if(Auth::user()->role == 'pedagang')
            <x-responsive-nav-link :href="route('pedagang.dashboard')" :active="request()->routeIs('pedagang.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pedagang.kios')" :active="request()->routeIs('pedagang.kios')">
                {{ __('Data Kios') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pedagang.sewa.index')" :active="request()->routeIs('pedagang.sewa.*')">
                {{ __('Riwayat Sewa') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pedagang.jadwaljanji.index')" :active="request()->routeIs('pedagang.jadwaljanji.index')">
                {{ __('Jadwal janji') }}
            </x-responsive-nav-link>
        @endif

        @if(Auth::user()->role == 'staff')
            <x-responsive-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('staff.pembayaran.index')" :active="request()->routeIs('staff.pembayaran.index')">
                {{ __('Data Pembayaran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('staff.pembayaran.history')" :active="request()->routeIs('staff.pembayaran.history')">
                {{ __('Riwayat Data Pembayaran') }}
            </x-responsive-nav-link>
        @endif

        @if(Auth::user()->role == 'manager')
            <x-responsive-nav-link :href="route('manager.dashboard')" :active="request()->routeIs('manager.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('manager.kios')" :active="request()->routeIs('manager.kios')">
                {{ __('Semua Kios') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('manager.kios.available')" :active="request()->routeIs('manager.kios.available')">
                {{ __('Kios Tersedia') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('manager.kios.occupied')" :active="request()->routeIs('manager.kios.occupied')">
                {{ __('Kios Terisi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('manager.pembayaran')" :active="request()->routeIs('manager.pembayaran')">
                {{ __('Data Pembayaran') }}
            </x-responsive-nav-link>
        @endif
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>

</nav>
