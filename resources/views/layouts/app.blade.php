<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kost')</title>
    
    {{-- TODO: Include Vite CSS (Tailwind) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    {{-- Navbar --}}
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo / Brand --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-lg sm:text-xl font-bold text-gray-800">
                        Sistem Kost
                    </a>
                </div>
                
                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'font-bold text-gray-900' : '' }}">Dashboard</a>
                    <a href="{{ route('kamar.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('kamar.*') ? 'font-bold text-gray-900' : '' }}">Kamar</a>
                    <a href="{{ route('penyewa.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('penyewa.*') ? 'font-bold text-gray-900' : '' }}">Penyewa</a>
                    <a href="{{ route('kontrak-sewa.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('kontrak-sewa.*') ? 'font-bold text-gray-900' : '' }}">Kontrak</a>
                    <a href="{{ route('pembayaran.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('pembayaran.*') ? 'font-bold text-gray-900' : '' }}">Pembayaran</a>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-gray-100 font-bold text-gray-900' : '' }}">Dashboard</a>
                <a href="{{ route('kamar.index') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kamar.*') ? 'bg-gray-100 font-bold text-gray-900' : '' }}">Kamar</a>
                <a href="{{ route('penyewa.index') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('penyewa.*') ? 'bg-gray-100 font-bold text-gray-900' : '' }}">Penyewa</a>
                <a href="{{ route('kontrak-sewa.index') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kontrak-sewa.*') ? 'bg-gray-100 font-bold text-gray-900' : '' }}">Kontrak</a>
                <a href="{{ route('pembayaran.index') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('pembayaran.*') ? 'bg-gray-100 font-bold text-gray-900' : '' }}">Pembayaran</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        {{-- Flash messages (success/error) --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        
        @yield('content')
    </main>

    {{-- Mobile Menu Script --}}
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const iconOpen = this.querySelector('svg:first-child');
            const iconClose = this.querySelector('svg:last-child');
            
            menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>
</body>
</html>
