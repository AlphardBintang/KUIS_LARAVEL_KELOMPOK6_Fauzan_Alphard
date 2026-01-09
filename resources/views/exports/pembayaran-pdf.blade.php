<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .header {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pembayaran Kost</h1>
        <p style="text-align: center; color: #666;">Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Nomor Kamar</th>
                <th>Bulan/Tahun</th>
                <th>Jumlah Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $index => $pembayaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</td>
                    <td>{{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</td>
                    <td>{{ $pembayaran->nama_bulan }} {{ $pembayaran->tahun }}</td>
                    <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($pembayaran->status) }}</td>
                    <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #e0e0e0; font-weight: bold;">
                <td colspan="4" style="text-align: right;">Total:</td>
                <td>Rp {{ number_format($pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}</td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Sistem Manajemen Kost - Laporan Pembayaran</p>
    </div>
</body>
</html>

