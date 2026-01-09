@extends('layouts.app')

@section('title', 'Buat Kontrak Sewa')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-0">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">Buat Kontrak Sewa Baru</h1>

    <form action="{{ route('kontrak-sewa.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-4 sm:p-6 space-y-4">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Penyewa</label>
            <select name="penyewa_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('penyewa_id') border-red-500 @enderror">
                <option value="">Pilih Penyewa</option>
                @foreach($penyewas as $penyewa)
                    <option value="{{ $penyewa->id }}" {{ old('penyewa_id') == $penyewa->id ? 'selected' : '' }}>
                        {{ $penyewa->nama_lengkap }} - {{ $penyewa->nomor_ktp }}
                    </option>
                @endforeach
            </select>
            @error('penyewa_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kamar Tersedia</label>
            <select name="kamar_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kamar_id') border-red-500 @enderror">
                <option value="">Pilih Kamar</option>
                @foreach($kamars as $kamar)
                    <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                        {{ $kamar->nomor_kamar }} - {{ ucfirst($kamar->tipe) }} - Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('kamar_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @if($kamars->isEmpty())
                <p class="mt-1 text-sm text-yellow-600">Tidak ada kamar tersedia saat ini</p>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_mulai') border-red-500 @enderror">
                @error('tanggal_mulai')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_selesai') border-red-500 @enderror">
                @error('tanggal_selesai')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Harga Bulanan (Rp)</label>
            <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan') }}" step="1000" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('harga_bulanan') border-red-500 @enderror">
            @error('harga_bulanan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:space-x-2 pt-4">
            <a href="{{ route('kontrak-sewa.index') }}" class="w-full sm:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection

