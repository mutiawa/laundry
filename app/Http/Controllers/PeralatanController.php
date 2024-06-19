<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query data
        $peralatan = Peralatan::all();
        return view('peralatan.view',
                    [
                        'peralatan' => $peralatan
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
        
        return view('peralatan/create',
        [
            'id_peralatan' => Peralatan::getIdPeralatan()
        ]
      );
        // return view('perusahaan/view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'id_peralatan' => 'required',
            'nama_peralatan' => 'required',
        ]);
    
        // Retrieve the validated input data
        $idPeralatan = $request->input('id_peralatan');
        $namaPeralatan = $request->input('nama_peralatan');
    
        // Check how many records exist with the same name
        $count = Peralatan::where('nama_peralatan', 'LIKE', $namaPeralatan . '%')->count();
    
        // If there are existing records, append the count to the nama_peralatan
        if ($count >= 0) {
            $namaPeralatan .= ' ' . ($count + 1);
        }
    
        // Create a new Peralatan instance with the validated data
        $newPeralatan = new Peralatan([
            'id_peralatan' => $idPeralatan,
            'nama_peralatan' => $namaPeralatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Save to the database
        $newPeralatan->save();
    
        return redirect()->route('peralatan.index')->with('success', 'Data Berhasil di Input');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(Peralatan $peralatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peralatan $peralatan)
    {
        return view('peralatan.edit', compact('peralatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peralatan $peralatan)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $peralatan = Peralatan::findOrFail($id);
        $peralatan->delete();

        return redirect()->route('peralatan.index')->with('success','Data Berhasil di Hapus');
    }
}