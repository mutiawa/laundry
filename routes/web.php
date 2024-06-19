<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\CobaMidtransController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');


// route untuk validasi login
Route::post('/validasi_login', [App\Http\Controllers\LoginController::class, 'show']);


// route coa
Route::get('/coa', [App\Http\Controllers\CoaController::class, 'index'])->name('coa.index');
Route::get('coa/fetchcoa', [App\Http\Controllers\CoaController::class,'fetchcoa'])->middleware(['auth']);
Route::get('coa/fetchAll', [App\Http\Controllers\CoaController::class,'fetchAll'])->middleware(['auth']);
Route::get('coa/edit/{id}', [App\Http\Controllers\CoaController::class,'edit'])->middleware(['auth']);
Route::get('coa/destroy/{id}', [App\Http\Controllers\CoaController::class,'destroy'])->middleware(['auth']);
Route::resource('/coa', App\Http\Controllers\CoaController::class)->middleware(['auth']);

// masterdata pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show');
Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::post('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
Route::delete('/pegawai/{pegawaiModel}', 'PegawaiController@destroy')->name('pegawai.destroy');
Route::get('pegawai/destroy/{id}', [App\Http\Controllers\PegawaiController::class, 'destroy'])->middleware(['auth']);
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
Route::delete('/pegawai/destroy/{id}', 'PegawaiController@destroy')->name('pegawai.destroy');

// presensi
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
Route::get('/presensi/destroy/{id}', [PresensiController::class, 'destroy'])->name('presensi.destroy');
Route::resource('presensi', PresensiController::class);

// penggajian
Route::get('/penggajian', [penggajianController::class, 'index'])->name('penggajian.index');
Route::post('/penggajian', [penggajianController::class, 'store'])->name('penggajian.store');
Route::get('/penggajian/destroy/{id}', [penggajianController::class, 'destroy'])->name('penggajian.destroy');
Route::resource('penggajian', penggajianController::class);

// bahan baku
Route::resource('/bahanbaku', BahanbakuController::class);
Route::get('/bahanbaku/destroy/{id}', [App\Http\Controllers\BahanbakuController::class,'destroy']);

// barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// layanan
Route::get('layanan', [App\Http\Controllers\LayananController::class, 'index']);
Route::resource('/layanan', App\Http\Controllers\LayananController::class)->middleware(['auth']);
Route::get('/layanan/destroy/{id}', [App\Http\Controllers\LayananController::class,'destroy'])->middleware(['auth']);

// untuk transaksi penjualan
Route::get('penjualan/layanan/{id}', [App\Http\Controllers\PenjualanController::class,'getDataLayanan'])->middleware(['auth']);
Route::get('penjualan/keranjang', [App\Http\Controllers\PenjualanController::class,'keranjang'])->middleware(['auth']);
Route::get('penjualan/destroypenjualandetail/{id}', [App\Http\Controllers\PenjualanController::class,'destroypenjualandetail'])->middleware(['auth']);
Route::get('penjualan/layanan', [App\Http\Controllers\PenjualanController::class,'getDataLayananAll'])->middleware(['auth']);
Route::get('penjualan/jmllayanan', [App\Http\Controllers\PenjualanController::class,'getJumlahLayanan'])->middleware(['auth']);
Route::get('penjualan/keranjangjson', [App\Http\Controllers\PenjualanController::class,'keranjangjson'])->middleware(['auth']);
Route::get('penjualan/checkout', [App\Http\Controllers\PenjualanController::class,'checkout'])->middleware(['auth']);
Route::get('penjualan/invoice', [App\Http\Controllers\PenjualanController::class,'invoice'])->middleware(['auth']);
Route::get('penjualan/jmlinvoice', [App\Http\Controllers\PenjualanController::class,'getInvoice'])->middleware(['auth']);
Route::get('penjualan/status', [App\Http\Controllers\PenjualanController::class,'viewstatus'])->middleware(['auth']);
Route::resource('penjualan', App\Http\Controllers\PenjualanController::class)->middleware(['auth']);

// transaksi pembayaran viewkeranjang
Route::get('pembayaran/viewkeranjang', [App\Http\Controllers\PembayaranController::class,'viewkeranjang'])->middleware(['auth']);
Route::get('pembayaran/viewstatus', [App\Http\Controllers\PembayaranController::class,'viewstatus'])->middleware(['auth']); 
Route::get('pembayaran/viewapprovalstatus', [App\Http\Controllers\PembayaranController::class,'viewapprovalstatus'])->middleware(['auth']);
Route::get('pembayaran/approve/{no_transaksi}', [App\Http\Controllers\PembayaranController::class,'approve'])->middleware(['auth']);
Route::get('pembayaran/unapprove/{no_transaksi}', [App\Http\Controllers\PembayaranController::class,'unapprove'])->middleware(['auth']);
Route::get('pembayaran/viewstatusPG', [App\Http\Controllers\PembayaranController::class,'viewstatusPG'])->middleware(['auth']);
Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class)->middleware(['auth']);

Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum'])->middleware(['auth']);
Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum'])->middleware(['auth']);
Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar'])->middleware(['auth']);
Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar'])->middleware(['auth']);

Route::get('pelanggan', [PelangganController::class, 'index'])->middleware('auth');
Route::get('/pelanggan/destroy/{id}', [PelangganController::class,'destroy'])->middleware(['auth']);
Route::get('/pelanggan/{id}/edit', [PelangganController::class,'edit'])->middleware(['auth']);
Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::resource('/pelanggan', PelangganController::class)->middleware(['auth']);

Route::resource('/pelanggan', PelangganController::class)->middleware(['auth']);
Route::get('peralatan', [PeralatanController::class, 'index']);
Route::resource('/peralatan', App\Http\Controllers\PeralatanController::class)->middleware(['auth']);
Route::get('/peralatan/destroy/{id}', [App\Http\Controllers\PeralatanController::class,'destroy'])->middleware(['auth']);

// untuk midtrans
Route::get('midtrans', [App\Http\Controllers\CobaMidtransController::class,'index'])->middleware(['auth']);
Route::get('midtrans/status', [App\Http\Controllers\CobaMidtransController::class,'cekstatus2'])->middleware(['auth']);
Route::get('midtrans/status2/{id}', [App\Http\Controllers\CobaMidtransController::class,'cekstatus'])->middleware(['auth']);
Route::get('midtrans/bayar', [App\Http\Controllers\CobaMidtransController::class,'bayar'])->middleware(['auth']);
Route::post('midtrans/proses_bayar', [App\Http\Controllers\CobaMidtransController::class,'proses_bayar'])->middleware(['auth']);

Route::get('api/berita1', [App\Http\Controllers\BeritaController::class,'getNews1'])->middleware(['auth']);
Route::get('api/berita2', [App\Http\Controllers\BeritaController::class,'getNews2'])->middleware(['auth']);


require __DIR__ . '/auth.php';
