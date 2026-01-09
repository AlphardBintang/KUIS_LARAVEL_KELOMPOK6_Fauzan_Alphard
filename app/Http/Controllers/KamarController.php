<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// TODO: Import model Kamar

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO: Ambil semua data kamar dari database
        // TODO: Tampilkan ke view 'kamar.index'
        // BONUS: Implementasi filter berdasarkan status/tipe
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: Tampilkan form tambah kamar di view 'kamar.create'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Validasi input (nomor_kamar unique, harga positif, dll)
        // TODO: Simpan data kamar baru ke database
        // TODO: Redirect ke index dengan pesan sukses
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // TODO: Ambil data kamar berdasarkan id
        // TODO: Tampilkan detail kamar di view 'kamar.show'
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TODO: Ambil data kamar berdasarkan id
        // TODO: Tampilkan form edit di view 'kamar.edit'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: Validasi input
        // TODO: Update data kamar
        // TODO: Redirect ke index dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Hapus data kamar (cek dulu apakah sudah pernah disewa)
        // TODO: Redirect dengan pesan sukses/error
    }
}
