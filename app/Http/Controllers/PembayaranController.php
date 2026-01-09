<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with(['kontrakSewa.penyewa', 'kontrakSewa.kamar'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kontraks = KontrakSewa::where('status', 'aktif')
            ->with(['penyewa', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $kontrakId = $request->get('kontrak_id');
        
        return view('pembayaran.create', compact('kontraks', 'kontrakId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kontrak_sewa_id' => 'required|exists:kontrak_sewa,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|digits:4',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:lunas,tertunggak',
            'keterangan' => 'nullable|string',
        ], [
            'kontrak_sewa_id.required' => 'Kontrak sewa wajib dipilih',
            'kontrak_sewa_id.exists' => 'Kontrak sewa tidak ditemukan',
            'bulan.required' => 'Bulan wajib diisi',
            'bulan.integer' => 'Bulan harus berupa angka',
            'bulan.min' => 'Bulan harus antara 1-12',
            'bulan.max' => 'Bulan harus antara 1-12',
            'tahun.required' => 'Tahun wajib diisi',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.digits' => 'Tahun harus 4 digit',
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi',
            'jumlah_bayar.numeric' => 'Jumlah bayar harus berupa angka',
            'jumlah_bayar.min' => 'Jumlah bayar harus positif',
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi',
            'tanggal_bayar.date' => 'Tanggal bayar harus berupa tanggal',
        ]);

        Pembayaran::create($validated);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dicatat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembayaran = Pembayaran::with(['kontrakSewa.penyewa', 'kontrakSewa.kamar'])
            ->findOrFail($id);
        
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $kontraks = KontrakSewa::where('status', 'aktif')
            ->with(['penyewa', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pembayaran.edit', compact('pembayaran', 'kontraks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        $validated = $request->validate([
            'kontrak_sewa_id' => 'required|exists:kontrak_sewa,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|digits:4',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:lunas,tertunggak',
            'keterangan' => 'nullable|string',
        ], [
            'kontrak_sewa_id.required' => 'Kontrak sewa wajib dipilih',
            'kontrak_sewa_id.exists' => 'Kontrak sewa tidak ditemukan',
            'bulan.required' => 'Bulan wajib diisi',
            'bulan.integer' => 'Bulan harus berupa angka',
            'bulan.min' => 'Bulan harus antara 1-12',
            'bulan.max' => 'Bulan harus antara 1-12',
            'tahun.required' => 'Tahun wajib diisi',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.digits' => 'Tahun harus 4 digit',
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi',
            'jumlah_bayar.numeric' => 'Jumlah bayar harus berupa angka',
            'jumlah_bayar.min' => 'Jumlah bayar harus positif',
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi',
            'tanggal_bayar.date' => 'Tanggal bayar harus berupa tanggal',
        ]);

        $pembayaran->update($validated);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus');
    }
}
