<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'penggajian.view',
            [
                'penggajian' => Penggajian::all(),
                'pegawais' => Pegawai::all(),
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
        // Digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'nama_pegawai' => 'required',
            'periode' => 'required|date_format:Y-m', // Ensure periode is in 'Y-m' format
        ]);
    
        $gajiPokok = 130000;
    
        // Parse the periode to get month and year
        $periode = Carbon::createFromFormat('Y-m', $request->periode);
    
        $pegawai = Pegawai::where('nama_pegawai', $request->nama_pegawai)->first();
    
        // Get the total kehadiran for the specified month and year
        $totalKehadiran = DB::table('presensi')
        ->where('nama_pegawai', $request->nama_pegawai)
        ->whereMonth('created_at', $periode->format('m'))
        ->whereYear('created_at', $periode->format('Y'))
        ->count();

        // Set the first day of the month for the 'periode' field
        $periodeDate = $periode->firstOfMonth();

        // Simpan data penggajian ke dalam database
        $penggajian = Penggajian::create([
            'nama_pegawai' => $request->nama_pegawai,
        'periode' => $periodeDate, // Use the formatted date for 'periode'
            'kehadiran' => $totalKehadiran,
            'gaji_pokok' => $gajiPokok,
            'jumlah_gaji' => $totalKehadiran * $gajiPokok,
        ]);
    
        return redirect()->route('penggajian.index')->with('success', 'Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penggajian $penggajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggajian $penggajian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $penggajian = Penggajian::findOrFail($id);
        $penggajian->delete();

        return redirect()->route('penggajian.index')->with('success', 'Data Berhasil di Hapus');
    }
}