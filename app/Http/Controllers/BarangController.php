<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('barang.create', [
            'kode_barang' => Barang::getKodeBarang(),
        ]);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'stok_tersedia' => 'required|numeric',
            'satuan' => 'required',
            'tanggal_pembelian_terakhir' => 'required|date',
            'deskripsi' => 'nullable',
        ]);
    
        // Menyimpan gambar
        // $imagePath = $request->file('image')->store('barang', 'public');
    
        // Buat instance barang baru
        $barangs = new Barang();
        $barangs->nama_barang = $request->nama_barang;
        $barangs->kategori = $request->kategori;
        $barangs->harga_beli = $request->harga_beli;
        $barangs->stok_tersedia = $request->stok_tersedia;
        $barangs->satuan = $request->satuan;
        $barangs->tanggal_pembelian_terakhir = $request->tanggal_pembelian_terakhir;
        $barangs->deskripsi = $request->deskripsi;
        // $barangs->image = $imagePath;
    
        // Simpan barang ke dalam database
        $barangs->save();
    
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan.');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $barangs = Barang::findOrFail($id);
        return view('barang.edit', compact('barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validasi data
    $validated = $request->validate([
        'kode_barang' => 'required',
        'nama_barang' => 'required',
        'kategori' => 'required',
        'stok_tersedia' => 'required|integer',
        'deskripsi' => 'nullable|string',
    ]);

    // Cari barang berdasarkan ID
    $barang = Barang::findOrFail($id);

    // Update data barang
    $barang->update($validated);

    // Redirect atau kembalikan response
    return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangs = Barang::findOrFail($id);
        $barangs->delete();
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
    
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
