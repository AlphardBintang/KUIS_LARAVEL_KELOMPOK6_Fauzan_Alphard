@extends('layouts.app')

@section('title', 'Detail Kontrak Sewa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Detail Kontrak Sewa</h1>
        <div class="space-x-2">
            <a href="{{ route('kontrak-sewa.edit', $kontrak->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <a href="{{ route('kontrak-sewa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>

    {{-- Informasi Kontrak --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Kontrak</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Penyewa</label>
                <p class="mt-1 text-sm text-gray-900">{{ $kontrak->penyewa->nama_lengkap }}</p>
                <p class="text-xs text-gray-500">{{ $kontrak->penyewa->nomor_telepon }} | {{ $kontrak->penyewa->nomor_ktp }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Kamar</label>
                <p class="mt-1 text-sm text-gray-900">{{ $kontrak->kamar->nomor_kamar }} - {{ ucfirst($kontrak->kamar->tipe) }}</p>
                <p class="text-xs text-gray-500">{{ $kontrak->kamar->fasilitas }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal Mulai</label>
                <p class="mt-1 text-sm text-gray-900">{{ $kontrak->tanggal_mulai->format('d/m/Y') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal Selesai</label>
                <p class="mt-1 text-sm text-gray-900">{{ $kontrak->tanggal_selesai->format('d/m/Y') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Harga Bulanan</label>
                <p class="mt-1 text-sm text-gray-900 font-semibold">Rp {{ number_format($kontrak->harga_bulanan, 0, ',', '.') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <p class="mt-1">
                    @if($kontrak->status === 'aktif')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Selesai</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- Riwayat Pembayaran --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900">Riwayat Pembayaran</h2>
            @if($kontrak->status === 'aktif')
                <a href="{{ route('pembayaran.create') }}?kontrak_id={{ $kontrak->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                    + Catat Pembayaran
                </a>
            @endif
        </div>
        @if($kontrak->pembayaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan/Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Bayar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Bayar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($kontrak->pembayaran as $pembayaran)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembayaran->nama_bulan }} {{ $pembayaran->tahun }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($pembayaran->status === 'lunas')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tertunggak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $pembayaran->keterangan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Belum ada riwayat pembayaran</p>
        @endif
    </div>
</div>
@endsection

