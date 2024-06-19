<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.view', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {     

        return view('pelanggan/create',['id_pelanggan' => Pelanggan::getPelangganId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelangganRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'id_pelanggan' => 'required',
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'no_telp_pelanggan' => 'required',
            'jenis_kelamin_pelanggan' => 'required',
            'alamat' => 'required',
        ]);

        // masukkan ke db
        Pelanggan::create($request->all());
        
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil di Input');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdatePelangganRequest  $request
     * @param  \App\Models\Pelanggan  
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'id_pelanggan' => 'required',
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'no_telp_pelanggan' => 'required',
            'alamat' => 'required',
            'jenis_kelamin_pelanggan' => 'required',
        ]);    

        $pelanggan->update($validated);
    
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil di Hapus');
    }
    
}