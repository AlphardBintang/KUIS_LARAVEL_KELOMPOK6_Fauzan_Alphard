@extends('layouts.app')

@section('title', 'Edit Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Kamar</h1>

    <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')
        
        {{-- Input Nomor Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" placeholder="Contoh: A1, B2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nomor_kamar') border-red-500 @enderror">
            @error('nomor_kamar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Select Tipe Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
            <select name="tipe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tipe') border-red-500 @enderror">
                <option value="">Pilih Tipe</option>
                <option value="standard" {{ old('tipe', $kamar->tipe) == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="deluxe" {{ old('tipe', $kamar->tipe) == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="vip" {{ old('tipe', $kamar->tipe) == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>
            @error('tipe')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Harga Bulanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Harga Bulanan (Rp)</label>
            <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan', $kamar->harga_bulanan) }}" step="1000" min="0" placeholder="Contoh: 1000000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('harga_bulanan') border-red-500 @enderror">
            @error('harga_bulanan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Textarea Fasilitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Fasilitas</label>
            <textarea name="fasilitas" rows="3" placeholder="Contoh: AC, WiFi, Kamar Mandi Dalam, dll" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fasilitas') border-red-500 @enderror">{{ old('fasilitas', $kamar->fasilitas) }}</textarea>
            @error('fasilitas')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Select Status --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ old('status', $kamar->status) == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('kamar.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection

