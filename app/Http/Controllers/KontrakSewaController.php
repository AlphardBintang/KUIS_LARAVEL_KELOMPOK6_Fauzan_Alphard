<?php

namespace App\Http\Controllers;

use App\Models\KontrakSewa;
use App\Models\Penyewa;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KontrakSewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontraks = KontrakSewa::with(['penyewa', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('kontrak-sewa.index', compact('kontraks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penyewas = Penyewa::orderBy('nama_lengkap')->get();
        $kamars = Kamar::where('status', 'tersedia')
            ->orderBy('nomor_kamar')
            ->get();
        
        return view('kontrak-sewa.create', compact('penyewas', 'kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai',
        ], [
            'penyewa_id.required' => 'Penyewa wajib dipilih',
            'penyewa_id.exists' => 'Penyewa tidak ditemukan',
            'kamar_id.required' => 'Kamar wajib dipilih',
            'kamar_id.exists' => 'Kamar tidak ditemukan',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.after' => 'Tanggal selesai harus lebih besar dari tanggal mulai',
            'harga_bulanan.required' => 'Harga bulanan wajib diisi',
            'harga_bulanan.numeric' => 'Harga bulanan harus berupa angka',
            'harga_bulanan.min' => 'Harga bulanan harus positif',
        ]);

        // Cek apakah kamar masih tersedia
        $kamar = Kamar::findOrFail($validated['kamar_id']);
        if ($kamar->status !== 'tersedia') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kamar sudah tidak tersedia');
        }

        // Buat kontrak
        $kontrak = KontrakSewa::create($request->all());

        // Update status kamar menjadi terisi
        $kamar = Kamar::find($request->kamar_id);
        $kamar->update(['status' => 'terisi']);

        return redirect()->route('kontrak.index')->with('success', 'Kontrak berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar', 'pembayaran'])
            ->findOrFail($id);
        
        return view('kontrak-sewa.show', compact('kontrak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        $penyewas = Penyewa::orderBy('nama_lengkap')->get();
        $kamars = Kamar::orderBy('nomor_kamar')->get();
        
        return view('kontrak-sewa.edit', compact('kontrak', 'penyewas', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        
        $validated = $request->validate([
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai',
        ], [
            'penyewa_id.required' => 'Penyewa wajib dipilih',
            'penyewa_id.exists' => 'Penyewa tidak ditemukan',
            'kamar_id.required' => 'Kamar wajib dipilih',
            'kamar_id.exists' => 'Kamar tidak ditemukan',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.after' => 'Tanggal selesai harus lebih besar dari tanggal mulai',
            'harga_bulanan.required' => 'Harga bulanan wajib diisi',
            'harga_bulanan.numeric' => 'Harga bulanan harus berupa angka',
            'harga_bulanan.min' => 'Harga bulanan harus positif',
        ]);

        // Jika status berubah menjadi selesai, kembalikan status kamar ke tersedia
        if ($validated['status'] === 'selesai' && $kontrak->status === 'aktif') {
            $kamar = Kamar::findOrFail($validated['kamar_id']);
            $kamar->update(['status' => 'tersedia']);
        }

        $kontrak->update($validated);

        return redirect()->route('kontrak-sewa.index')
            ->with('success', 'Kontrak sewa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        
        // Jika kontrak aktif, kembalikan status kamar ke tersedia
        if ($kontrak->status === 'aktif') {
            $kamar = Kamar::findOrFail($kontrak->kamar_id);
            $kamar->update(['status' => 'tersedia']);
        }

        $kontrak->delete();

        return redirect()->route('kontrak-sewa.index')
            ->with('success', 'Kontrak sewa berhasil dihapus');
    }
}
