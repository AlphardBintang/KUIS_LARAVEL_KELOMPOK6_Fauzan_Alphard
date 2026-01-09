@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Detail Pembayaran</h1>
        <div class="space-x-2">
            <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <a href="{{ route('pembayaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>

    {{-- Informasi Pembayaran --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pembayaran</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Penyewa</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</p>
                <p class="text-xs text-gray-500">{{ $pembayaran->kontrakSewa->penyewa->nomor_telepon }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Kamar</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->kontrakSewa->kamar->nomor_kamar }} - {{ ucfirst($pembayaran->kontrakSewa->kamar->tipe) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Bulan/Tahun</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->nama_bulan }} {{ $pembayaran->tahun }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal Bayar</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Jumlah Bayar</label>
                <p class="mt-1 text-sm text-gray-900 font-semibold">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <p class="mt-1">
                    @if($pembayaran->status === 'lunas')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tertunggak</span>
                    @endif
                </p>
            </div>
            @if($pembayaran->keterangan)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Keterangan</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->keterangan }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Informasi Kontrak --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Kontrak Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal Mulai Kontrak</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->kontrakSewa->tanggal_mulai->format('d/m/Y') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal Selesai Kontrak</label>
                <p class="mt-1 text-sm text-gray-900">{{ $pembayaran->kontrakSewa->tanggal_selesai->format('d/m/Y') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Harga Bulanan</label>
                <p class="mt-1 text-sm text-gray-900">Rp {{ number_format($pembayaran->kontrakSewa->harga_bulanan, 0, ',', '.') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status Kontrak</label>
                <p class="mt-1">
                    @if($pembayaran->kontrakSewa->status === 'aktif')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Selesai</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('kontrak-sewa.show', $pembayaran->kontrak_sewa_id) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                → Lihat Detail Kontrak
            </a>
        </div>
    </div>
</div>
@endsection

