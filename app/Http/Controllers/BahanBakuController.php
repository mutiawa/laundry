<?php

namespace App\Http\Controllers;

use App\Models\bahanbaku;
use Illuminate\Http\Request;

class bahanbakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //menampilkan data bahanbaku
    public function index()
    {
        //query data
        $bahanbaku = bahanbaku::all();
        return view('bahanbaku.view',
                    [
                        'bahanbaku' => $bahanbaku
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // berikan kode bahanbaku secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        //mengambil dan mengembalikan data dari bd
        
        return view('bahanbaku/create',
                    [
                        'bahanbaku_kode' => bahanbaku::getKodebahanbaku()
                    ]
                  );

        return view('bahanbaku/view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bahanbaku_kode' => 'required',
            'bahanbaku_nama' => 'required',
            // 'harga_bahanbaku' => 'required',
            'bahanbaku_jenis' => 'required',
            'bahanbaku_satuan' => 'required',
        ]);
        
        $empData = [
            'bahanbaku_kode' => $request->input('bahanbaku_kode'),
            'bahanbaku_nama' => $request->input('bahanbaku_nama'),
            // 'harga_bahanbaku' => $request->input('harga_bahanbaku'),
            'bahanbaku_jenis' => $request->input('bahanbaku_jenis'),
            'bahanbaku_satuan' => $request->input('bahanbaku_satuan'),
        ];
    
        Bahanbaku::create($empData);
    
        return redirect()->route('bahanbaku.index')
                        ->with('success', 'Bahanbaku created successfully.');
    }

    /**,.
     * Display the specified resource.
     */
    public function show(bahanbaku $bahanbaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bahanbaku $bahanbaku)
    {
        return view('bahanbaku.edit', compact('bahanbaku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bahanbaku $bahanbaku)
    {
        $request->validate([
            'bahanbaku_kode' => 'required',
            'bahanbaku_nama' => 'required',
            // 'harga_bahanbaku' => 'required',
            'bahanbaku_jenis' => 'required',
            'bahanbaku_satuan' => 'required',
        ]);
    
        $empData = [
            'bahanbaku_kode' => $request->input('bahanbaku_kode'),
            'bahanbaku_nama' => $request->input('bahanbaku_nama'),
            // 'harga_bahanbaku' => $request->input('harga_bahanbaku'),
            'bahanbaku_jenis' => $request->input('bahanbaku_jenis'),
            'bahanbaku_satuan' => $request->input('bahanbaku_satuan'),
        ];
    
        $bahanbaku->update($empData);
    
        return redirect()->route('bahanbaku.index')
                        ->with('success', 'Bahanbaku updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
         //hapus dari database
        $bahanbaku = bahanbaku::findOrFail($id);
        $bahanbaku->delete();

        return redirect()->route('bahanbaku.index')->with('success','Data Berhasil di Hapus');
    }
}