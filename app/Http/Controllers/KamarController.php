<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // 1. List kamar & filter
    public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('nomor_kamar', 'like', '%' . $request->search . '%');
        }

        $kamars = $query->latest()->paginate(10);

        return view('kamar.index', compact('kamars'));
    }

    // 2. Tambah kamar (Form)
    public function create()
    {
        return view('kamar.create');
    }

    // 2. Tambah kamar (Store)
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamar,nomor_kamar|max:10',
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
        ]);

        Kamar::create($request->all());

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    // 3. Edit kamar (Form)
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar'));
    }

    // 3. Edit kamar (Update)
    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nomor_kamar' => 'required|max:10|unique:kamar,nomor_kamar,' . $kamar->id,
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $kamar->update($request->all());

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diperbarui');
    }

    // 4. Hapus kamar
    public function destroy(Kamar $kamar)
    {
        if ($kamar->kontrakSewa()->exists()) {
            return back()->with('error', 'Kamar tidak bisa dihapus karena memiliki riwayat sewa.');
        }

        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}