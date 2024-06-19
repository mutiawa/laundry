<?php

namespace App\Http\Controllers;

use App\Models\PegawaiModel;
use Illuminate\Http\Request;


class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = PegawaiModel::all(); // Gunakan nama model dengan benar

        return view('pegawai.index', [
            'pegawai' => $pegawai
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create', [
            'kode_pegawai' => PegawaiModel::getKodepegawai()
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
        // Validasi data yang diterima dari formulir jika diperlukan
        $request->validate([
            'kode_pegawai' => 'required|string',
            'nama_pegawai' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin_pegawai' => 'required|string',
            'no_telp_pegawai' => 'required|string',
        ]);

        // Simpan data ke dalam database
        PegawaiModel::create([
            'kode_pegawai' => $request->kode_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'alamat' => $request->alamat,
            'jenis_kelamin_pegawai' => $request->jenis_kelamin_pegawai,
            'no_telp_pegawai' => $request->no_telp_pegawai
        ]);

        // Arahkan pengguna ke halaman home
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function show(PegawaiModel $pegawaiModel)
    {
        return view('pegawai.show', compact('pegawaiModel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = PegawaiModel::findOrFail($id);

        return view('pegawai.edit', [
            'id' => $id,
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan dari formulir
        $validated = $request->validate([
            'kode_pegawai' => 'required',
            'nama_pegawai' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin_pegawai' => 'required|string',
            'no_telp_pegawai' => 'required|string',
        ]);

        // Mengambil data pegawai berdasarkan $id
        $pegawai = PegawaiModel::findOrFail($id);

        // Mengupdate data pegawai dengan data yang telah divalidasi
        $pegawai->update($validated);

        // Redirect ke halaman pegawai dengan pesan sukses
        return redirect()->route('pegawai.index')->with('success', 'Data Berhasil di Ubah');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        // Cari entitas Pegawai berdasarkan ID
        $pegawai = PegawaiModel::findOrFail($id);

        // Hapus entitas dari database
        $pegawai->delete();

        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus.');
    }
}
