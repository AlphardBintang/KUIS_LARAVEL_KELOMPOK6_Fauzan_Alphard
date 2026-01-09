@extends('layouts.app')

@section('content')
<div class="w-full">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Kamar</h1>
        <a href="{{ route('kamar.create') }}" class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center">
            + Tambah Kamar
        </a>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-4 sm:mb-6">
        <form action="{{ route('kamar.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <select name="status" class="w-full sm:w-auto border rounded p-2 text-sm">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
            
            <select name="tipe" class="w-full sm:w-auto border rounded p-2 text-sm">
                <option value="">Semua Tipe</option>
                <option value="standard" {{ request('tipe') == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="deluxe" {{ request('tipe') == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="vip" {{ request('tipe') == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>

            <div class="flex gap-2 w-full sm:w-auto">
                <button type="submit" class="flex-1 sm:flex-none bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">Filter</button>
                <a href="{{ route('kamar.index') }}" class="flex-1 sm:flex-none text-gray-600 px-4 py-2 text-center text-sm">Reset</a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">{{ session('error') }}</div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kamar</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($kamars as $kamar)
                    <tr>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap font-bold text-sm">{{ $kamar->nomor_kamar }}</td>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap capitalize text-sm">{{ $kamar->tipe }}</td>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kamar->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($kamar->status) }}
                            </span>
                        </td>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-0">
                                <a href="{{ route('kamar.edit', $kamar->id) }}" class="text-indigo-600 hover:text-indigo-900 sm:mr-3">Edit</a>
                                <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus kamar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $kamars->links() }}
    </div>
</div>
@endsection
