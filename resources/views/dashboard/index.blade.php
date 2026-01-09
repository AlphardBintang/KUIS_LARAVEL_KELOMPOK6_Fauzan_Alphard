@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>

    {{-- TODO: Buat cards untuk statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Card Total Kamar --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-500">Total Kamar</div>
            <div class="text-3xl font-bold text-gray-900">
                {{-- TODO: Tampilkan total kamar --}}
                0
            </div>
        </div>

        {{-- TODO: Card Kamar Terisi --}}
        {{-- TODO: Card Kamar Tersedia --}}
        {{-- TODO: Card Pendapatan Bulan Ini --}}
        {{-- TODO: Card Tunggakan --}}
    </div>

    {{-- TODO BONUS: Chart/Grafik (opsional) --}}
</div>
@endsection
