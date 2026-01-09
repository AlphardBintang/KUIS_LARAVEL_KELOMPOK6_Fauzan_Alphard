@extends('layouts.app')

@section('title', 'Detail Penyewa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Detail Penyewa</h1>
        <div class="space-x-2">
            <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <a href="{{ route('penyewa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>

    {{-- Informasi Penyewa --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Penyewa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                <p class="mt-1 text-sm text-gray-900">{{ $penyewa->nama_lengkap }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                <p class="mt-1 text-sm text-gray-900">{{ $penyewa->nomor_telepon }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Nomor KTP</label>
                <p class="mt-1 text-sm text-gray-900">{{ $penyewa->nomor_ktp }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                <p class="mt-1 text-sm text-gray-900">{{ $penyewa->pekerjaan }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Alamat Asal</label>
                <p class="mt-1 text-sm text-gray-900">{{ $penyewa->alamat_asal }}</p>
            </div>
        </div>
    </div>

    {{-- Riwayat Kontrak --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Riwayat Kontrak</h2>
        @if($penyewa->kontrakSewa->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Bulanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($penyewa->kontrakSewa as $kontrak)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kontrak->kamar->nomor_kamar }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kontrak->tanggal_mulai->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kontrak->tanggal_selesai->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($kontrak->harga_bulanan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($kontrak->status === 'aktif')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('kontrak-sewa.show', $kontrak->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Belum ada riwayat kontrak</p>
        @endif
    </div>
</div>
@endsection

