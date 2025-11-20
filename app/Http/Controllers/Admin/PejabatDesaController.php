<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PejabatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PejabatDesaController extends Controller
{
    public function index()
    {
        $pejabatList = PejabatDesa::all();
        return view('admin.pejabat_desa.index', compact('pejabatList'));
    }

    public function create()
    {
        return view('admin.pejabat_desa.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_pejabat' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:30',         // <-- Validasi NIP
            'tanggal_lahir' => 'nullable|date',        // <-- Validasi Tgl Lahir
        ]);

        // 2. Buat Objek Baru (BAGIAN INI YANG HILANG SEBELUMNYA)
        $pejabat = new PejabatDesa(); 

        // 3. Isi Data
        $pejabat->nama_pejabat = $request->nama_pejabat;
        $pejabat->jabatan = $request->jabatan;
        $pejabat->nip = $request->nip;                 // <-- Simpan NIP
        $pejabat->tanggal_lahir = $request->tanggal_lahir; // <-- Simpan Tgl Lahir
        
        // 4. Simpan ke Database
        $pejabat->save();

        return Redirect::route('pejabat-desa.index')->with('success', 'Data pejabat desa berhasil ditambahkan.');
    }

    public function edit(PejabatDesa $pejabatDesa) // Menggunakan Route Model Binding
    {
        // Ubah nama variabel jadi $pejabat agar sesuai dengan view edit.blade.php
        return view('admin.pejabat_desa.edit', ['pejabat' => $pejabatDesa]);
    }

    public function update(Request $request, PejabatDesa $pejabatDesa)
    {
        // 1. Validasi
        $request->validate([
            'nama_pejabat' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:30',
            'tanggal_lahir' => 'nullable|date',
        ]);

        // 2. Update Data (Gunakan objek $pejabatDesa yang ditemukan otomatis)
        $pejabatDesa->nama_pejabat = $request->nama_pejabat;
        $pejabatDesa->jabatan = $request->jabatan;
        $pejabatDesa->nip = $request->nip;
        $pejabatDesa->tanggal_lahir = $request->tanggal_lahir;
        
        // 3. Simpan Perubahan
        $pejabatDesa->save();

        return Redirect::route('pejabat-desa.index')->with('success', 'Data pejabat desa berhasil diperbarui.');
    }

    public function destroy(PejabatDesa $pejabatDesa)
    {
        try {
            $pejabatDesa->delete();
            return Redirect::route('pejabat-desa.index')->with('success', 'Data pejabat desa berhasil dihapus.');
        } catch (\Exception $e) {
            return Redirect::route('pejabat-desa.index')->with('error', 'Gagal menghapus: Data ini mungkin masih terhubung ke ajuan surat.');
        }
    }
}