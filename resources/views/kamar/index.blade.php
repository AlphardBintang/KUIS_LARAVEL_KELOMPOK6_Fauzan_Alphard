@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kamar</h1>
        <a href="{{ route('kamar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Tambah Kamar
        </a>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="{{ route('kamar.index') }}" method="GET" class="flex flex-wrap gap-4">
            <select name="status" class="border rounded p-2">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
            
            <select name="tipe" class="border rounded p-2">
                <option value="">Semua Tipe</option>
                <option value="standard" {{ request('tipe') == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="deluxe" {{ request('tipe') == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="vip" {{ request('tipe') == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>

            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Filter</button>
            <a href="{{ route('kamar.index') }}" class="text-gray-600 px-4 py-2">Reset</a>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($kamars as $kamar)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $kamar->nomor_kamar }}</td>
                    <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $kamar->tipe }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kamar->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($kamar->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('kamar.edit', $kamar->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus kamar ini?');">
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
    <div class="mt-4">
        {{ $kamars->links() }}
    </div>
</div>
@endsection