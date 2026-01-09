@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-0">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">Edit Pembayaran</h1>

    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-4 sm:p-6 space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Kontrak Sewa</label>
            <select name="kontrak_sewa_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kontrak_sewa_id') border-red-500 @enderror">
                <option value="">Pilih Kontrak Sewa</option>
                @foreach($kontraks as $kontrak)
                    <option value="{{ $kontrak->id }}" {{ old('kontrak_sewa_id', $pembayaran->kontrak_sewa_id) == $kontrak->id ? 'selected' : '' }}>
                        {{ $kontrak->penyewa->nama_lengkap }} - Kamar {{ $kontrak->kamar->nomor_kamar }} ({{ $kontrak->status }})
                    </option>
                @endforeach
            </select>
            @error('kontrak_sewa_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Bulan</label>
                <select name="bulan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('bulan') border-red-500 @enderror">
                    <option value="">Pilih Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ old('bulan', $pembayaran->bulan) == $i ? 'selected' : '' }}>
                            {{ ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$i] }}
                        </option>
                    @endfor
                </select>
                @error('bulan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun', $pembayaran->tahun) }}" min="2000" max="2100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tahun') border-red-500 @enderror">
                @error('tahun')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah Bayar (Rp)</label>
            <input type="number" name="jumlah_bayar" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" step="1000" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jumlah_bayar') border-red-500 @enderror">
            @error('jumlah_bayar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_bayar') border-red-500 @enderror">
            @error('tanggal_bayar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="lunas" {{ old('status', $pembayaran->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="tertunggak" {{ old('status', $pembayaran->status) == 'tertunggak' ? 'selected' : '' }}>Tertunggak</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
            <textarea name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
            @error('keterangan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:space-x-2 pt-4">
            <a href="{{ route('pembayaran.index') }}" class="w-full sm:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection

