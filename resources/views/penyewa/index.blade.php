@extends('layouts.app')

@section('title', 'Daftar Penyewa')

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
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Daftar Penyewa</h1>
        <a href="{{ route('penyewa.create') }}" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center text-sm sm:text-base">
            + Tambah Penyewa
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Nomor Telepon</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Nomor KTP</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Pekerjaan</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kamar</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($penyewas as $index => $penyewa)
                        <tr class="{{ $penyewa->jumlah_tunggakan > 0 ? 'bg-red-50 hover:bg-red-100' : 'hover:bg-gray-50' }}">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                                    <span>{{ $penyewa->nama_lengkap }}</span>
                                    @if($penyewa->jumlah_tunggakan > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 animate-pulse" title="Memiliki {{ $penyewa->jumlah_tunggakan }} pembayaran tertunggak">
                                            {{ $penyewa->jumlah_tunggakan }} Tunggakan
                                        </span>
                                    @endif
                                </div>
                                <div class="sm:hidden text-xs text-gray-500 mt-1">
                                    <div>{{ $penyewa->nomor_telepon }}</div>
                                    <div class="mt-1">{{ $penyewa->pekerjaan }}</div>
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">{{ $penyewa->nomor_telepon }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">{{ $penyewa->nomor_ktp }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">{{ $penyewa->pekerjaan }}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($penyewa->kontrakAktif->count() > 0)
                                    @foreach($penyewa->kontrakAktif as $kontrak)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $kontrak->kamar->nomor_kamar }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-0 sm:space-x-2">
                                    <a href="{{ route('penyewa.show', $penyewa->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('penyewa.destroy', $penyewa->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penyewa ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 text-sm">
                                Belum ada data penyewa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
