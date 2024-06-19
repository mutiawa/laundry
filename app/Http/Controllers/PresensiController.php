<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'presensi.view',
            [
                'presensi' => Presensi::all(),
                'pegawais' => Pegawai::all(),
                'kode_presensi' => Presensi::getPresensiId()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_presensi' => 'required',
            'nama_pegawai' => 'required',
            'check_in' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);

        // Mengonversi nama pegawai menjadi nilai yang sesuai
        $namaPegawai = $request->nama_pegawai;
        $idPegawai = null;

        // Memetakan nama pegawai ke nilai yang sesuai
        switch ($namaPegawai) {
            case 'mutiara':
                $idPegawai = 1;
                break;
            case 'putra':
                $idPegawai = 2;
                break;
            case 'satrio':
                $idPegawai = 3;
                break;
            case 'purnomo':
                $idPegawai = 4;
                break;
            default:
                // Jika nama pegawai tidak sesuai, tidak melakukan apa-apa
                break;
        }

        // Simpan data presensi ke dalam database
        $presensi = Presensi::create([
            'kode_presensi' => $request->kode_presensi,
            'nama_pegawai' => $namaPegawai,
            'kode_pegawai' => $idPegawai,
            'check_in' => $validated['check_in'],
        ]);

        // Simpan gambar ke dalam penyimpanan
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article', 'public');
            $presensi->image = $imagePath;
            $presensi->save();
        }

        return redirect()->route('presensi.index')->with('success', 'Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('presensi.index')->with('success', 'Data Berhasil di Hapus');
    }
}