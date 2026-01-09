@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="space-y-4 sm:space-y-6">
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline text-sm">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Daftar Pembayaran</h1>
        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <div class="relative w-full sm:w-auto" id="exportDropdown">
                <button onclick="toggleExportDropdown()" class="w-full sm:w-auto bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center text-sm sm:text-base">
                    Export
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="exportMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                    <a href="{{ route('export.pembayaran.excel') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                        Export Excel
                    </a>
                    <a href="{{ route('export.pembayaran.pdf') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Export PDF
                    </a>
                </div>
            </div>
            <a href="{{ route('pembayaran.create') }}" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center text-sm sm:text-base">
                + Catat Pembayaran
            </a>
        </div>
        
        <script>
            function toggleExportDropdown() {
                const menu = document.getElementById('exportMenu');
                menu.classList.toggle('hidden');
            }
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('exportDropdown');
                const menu = document.getElementById('exportMenu');
                if (!dropdown.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penyewa</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">No. Kamar</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan/Tahun</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Jumlah Bayar</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Tanggal Bayar</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pembayarans as $index => $pembayaran)
                        <tr class="{{ $pembayaran->status === 'tertunggak' ? 'bg-red-50 hover:bg-red-100 border-l-4 border-red-500' : 'hover:bg-gray-50' }}">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                                    <span>{{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</span>
                                    @if($pembayaran->status === 'tertunggak')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 animate-pulse">
                                            !
                                        </span>
                                    @endif
                                </div>
                                <div class="sm:hidden text-xs text-gray-500 mt-1">
                                    <div>Kamar: {{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</div>
                                    <div class="mt-1">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</div>
                                    <div>{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">{{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pembayaran->nama_bulan }} {{ $pembayaran->tahun }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                @if($pembayaran->status === 'lunas')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tertunggak</span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-0 sm:space-x-2">
                                    <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-sm">
                                Belum ada data pembayaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
