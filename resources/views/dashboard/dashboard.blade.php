@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="w-full">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-8">Dashboard Kost Pak Budi</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 truncate">Total Kamar</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalKamar }}</p>
                </div>
                <div class="text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 truncate">Okupansi Kamar</p>
                    <div class="flex items-end space-x-2">
                        <p class="text-2xl font-semibold text-gray-900">{{ $kamarTerisi }} <span class="text-sm text-gray-400">Terisi</span></p>
                        <span class="text-gray-300">|</span>
                        <p class="text-lg font-medium text-gray-600">{{ $kamarTersedia }} <span class="text-sm text-gray-400">Kosong</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 truncate">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
                </div>
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 truncate">Pembayaran Tertunggak</p>
                    <p class="text-2xl font-semibold text-red-600">{{ $jumlahTunggakan }}</p>
                </div>
                <div class="text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Chart Pendapatan 6 Bulan Terakhir --}}
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Pendapatan 6 Bulan Terakhir</h3>
            <canvas id="pendapatanChart"></canvas>
        </div>

        {{-- Chart Status Pembayaran --}}
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Status Pembayaran</h3>
            <canvas id="statusPembayaranChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
        {{-- Chart Tipe Kamar --}}
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Distribusi Tipe Kamar</h3>
            <canvas id="tipeKamarChart"></canvas>
        </div>

        {{-- Ringkasan Okupansi --}}
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Ringkasan Okupansi</h3>
            <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                @php
                    $persentase = $totalKamar > 0 ? ($kamarTerisi / $totalKamar) * 100 : 0;
                @endphp
                <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $persentase }}%"></div>
            </div>
            <p class="text-sm text-gray-500 mt-2">{{ round($persentase) }}% dari total kamar sedang terisi.</p>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Chart Pendapatan 6 Bulan Terakhir
    const pendapatanCtx = document.getElementById('pendapatanChart').getContext('2d');
    new Chart(pendapatanCtx, {
        type: 'line',
        data: {
            labels: @json($labelBulan),
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json($pendapatanBulanan),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });

    // Chart Status Pembayaran
    const statusCtx = document.getElementById('statusPembayaranChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Lunas', 'Tertunggak'],
            datasets: [{
                data: [{{ $pembayaranLunas }}, {{ $pembayaranTertunggak }}],
                backgroundColor: [
                    'rgb(34, 197, 94)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1.2,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Chart Tipe Kamar
    const tipeCtx = document.getElementById('tipeKamarChart').getContext('2d');
    new Chart(tipeCtx, {
        type: 'bar',
        data: {
            labels: ['Standard', 'Deluxe', 'VIP'],
            datasets: [{
                label: 'Jumlah Kamar',
                data: [{{ $kamarStandard }}, {{ $kamarDeluxe }}, {{ $kamarVip }}],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(251, 191, 36, 0.8)'
                ],
                borderColor: [
                    'rgb(59, 130, 246)',
                    'rgb(168, 85, 247)',
                    'rgb(251, 191, 36)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
