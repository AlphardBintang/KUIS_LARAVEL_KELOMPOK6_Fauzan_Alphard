<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewas = Penyewa::with(['kontrakAktif.kamar'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('penyewa.index', compact('penyewas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyewa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|max:20|unique:penyewa,nomor_ktp',
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
        ], [
            'nomor_ktp.unique' => 'Nomor KTP sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi',
            'alamat_asal.required' => 'Alamat asal wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
        ]);

        Penyewa::create($validated);

        return redirect()->route('penyewa.index')
            ->with('success', 'Data penyewa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penyewa = Penyewa::with(['kontrakSewa.kamar'])
            ->findOrFail($id);
        
        return view('penyewa.show', compact('penyewa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        return view('penyewa.edit', compact('penyewa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|max:20|unique:penyewa,nomor_ktp,' . $id,
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
        ], [
            'nomor_ktp.unique' => 'Nomor KTP sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi',
            'alamat_asal.required' => 'Alamat asal wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
        ]);

        $penyewa->update($validated);

        return redirect()->route('penyewa.index')
            ->with('success', 'Data penyewa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        
        // Cek apakah penyewa memiliki kontrak aktif
        $kontrakAktif = KontrakSewa::where('penyewa_id', $id)
            ->where('status', 'aktif')
            ->exists();
        
        if ($kontrakAktif) {
            return redirect()->route('penyewa.index')
                ->with('error', 'Tidak dapat menghapus penyewa yang masih memiliki kontrak aktif');
        }

        $penyewa->delete();

        return redirect()->route('penyewa.index')
            ->with('success', 'Data penyewa berhasil dihapus');
    }
}
