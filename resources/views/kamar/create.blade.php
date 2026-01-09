@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Kamar Baru</h1>

    {{-- TODO: Form tambah kamar --}}
    <form action="#" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
        @csrf
        
        {{-- TODO: Input Nomor Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            {{-- TODO: Tampilkan error validation --}}
        </div>

        {{-- TODO: Select Tipe Kamar (standard, deluxe, vip) --}}
        {{-- TODO: Input Harga Bulanan --}}
        {{-- TODO: Textarea Fasilitas --}}
        {{-- TODO: Select Status (tersedia, terisi) --}}

        <div class="flex justify-end space-x-2">
            <a href="#" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
