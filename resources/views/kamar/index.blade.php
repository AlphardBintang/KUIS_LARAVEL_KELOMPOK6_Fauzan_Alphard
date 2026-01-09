@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Kamar</h1>
        {{-- TODO: Tombol tambah kamar --}}
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Kamar
        </a>
    </div>

    {{-- TODO: Filter berdasarkan status/tipe (BONUS) --}}

    {{-- TODO: Tabel daftar kamar --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- TODO: Loop data kamar --}}
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data kamar
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
