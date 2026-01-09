@extends('layouts.app')

@section('title', 'Tambah Penyewa')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-0">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">Tambah Penyewa Baru</h1>

    <form action="{{ route('penyewa.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-4 sm:p-6 space-y-4">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror">
            @error('nama_lengkap')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nomor_telepon') border-red-500 @enderror">
            @error('nomor_telepon')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor KTP</label>
            <input type="text" name="nomor_ktp" value="{{ old('nomor_ktp') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nomor_ktp') border-red-500 @enderror">
            @error('nomor_ktp')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat Asal (Alamat KTP)</label>
            <textarea name="alamat_asal" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('alamat_asal') border-red-500 @enderror">{{ old('alamat_asal') }}</textarea>
            @error('alamat_asal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Contoh: Mahasiswa, Karyawan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pekerjaan') border-red-500 @enderror">
            @error('pekerjaan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:space-x-2 pt-4">
            <a href="{{ route('penyewa.index') }}" class="w-full sm:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection

