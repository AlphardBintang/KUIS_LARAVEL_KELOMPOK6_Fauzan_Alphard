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
    {{-- TODO: Buat navbar dengan menu navigasi --}}
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                {{-- Logo / Brand --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                        Sistem Kost
                    </a>
                </div>
                
                {{-- Menu navigasi (Dashboard, Kamar, Penyewa, Kontrak, Pembayaran) --}}
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('dashboard') ? 'font-bold text-gray-900' : '' }}">Dashboard</a>
                    <a href="{{ route('kamar.index') }}" class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('kamar.*') ? 'font-bold text-gray-900' : '' }}">Kamar</a>
                    <a href="{{ route('penyewa.index') }}" class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('penyewa.*') ? 'font-bold text-gray-900' : '' }}">Penyewa</a>
                    <a href="{{ route('kontrak-sewa.index') }}" class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('kontrak-sewa.*') ? 'font-bold text-gray-900' : '' }}">Kontrak Sewa</a>
                    <a href="{{ route('pembayaran.index') }}" class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('pembayaran.*') ? 'font-bold text-gray-900' : '' }}">Pembayaran</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto py-6 px-4">
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

    {{-- TODO: Footer (opsional) --}}
</body>
</html>
