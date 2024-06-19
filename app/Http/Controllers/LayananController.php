<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query data
        $layanan = Layanan::all();
        return view('layanan.view',
                    [
                        'layanan' => $layanan
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // berikan kode perusahaan secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        
        return view('layanan/create',
        [
            'id_layanan' => Layanan::getIdLayanan()
        ]
      );
        // return view('perusahaan/view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'id_layanan' => 'required',
            'nama_layanan' => 'required',
            'jenis_layanan' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        // masukkan ke db
        Layanan::create($request->all());
        
        return redirect()->route('layanan.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'id_layanan' => 'required',
            'nama_layanan' => 'required',
            'jenis_layanan' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);
    
        $layanan->update($validated);
    
        return redirect()->route('layanan.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success','Data Berhasil di Hapus');
    }
}