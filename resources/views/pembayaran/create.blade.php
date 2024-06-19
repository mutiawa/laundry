@extends('layoutbootstrap')

@section('konten')

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <a href="#" class="btn btn-primary">{{ Auth::user()->name }}</a>
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="{{url('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Konfirmasi Pembayaran</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- dapatkan nomor transaksi dan total tagihan -->
                <?php 
                        $no_transaksi = '';
                        $totaltagihan = 0;
                        foreach($keranjang as $k):
                            $no_transaksi = $k->no_transaksi ;
                            $totaltagihan = $totaltagihan + $k->total ;
                        endforeach;
                ?>

                <!-- Awal Dari Input Form -->
                <form action="{{ route('pembayaran.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="no_transaksi" name="no_transaksi" value="{{$no_transaksi}}">
                        <input type="hidden" id="tipeproses" name="tipeproses" value="tunai">
                        <fieldset disabled>
                            <div class="mb-3"><label for="kodeperusahaanlabel">No Transaksi</label>
                            <input class="form-control form-control-solid" id="kode" name="kode" type="text" value="{{$no_transaksi}}" readonly></div>
                        </fieldset>
                        <div class="mb-3"><label for="namaperusahaanlabel">Isi Keranjang <b>({{$totaltagihan}})</b></label>
                          <ul class="list-group">
                            @foreach ($keranjang as $k)
                                <li class="list-group-item">
                                    <b>{{$k->nama_layanan}}</b> <br>
                                    <div class="row">

                                        <div class="col-sm-10" align="left">
                                            <table>
                                                <tr>
                                                    <td>
                                                    Harga per item
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">{{$k->harga}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                     <hr>
                                                    </td>
                                                    
                                                </tr>
                                                <tr> 
                                                    <td>
                                                    Total Harga  
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">
                                                        {{$k->total}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Bukti Bayar</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar" name="bukti_bayar" value="{{ old('bukti_bayar') }}">
                                @error('bukti_bayar')
                                    <div>{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>    

                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Tanggal Bayar</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control @error('tgl_bayar') is-invalid @enderror" id="tgl_bayar" name="tgl_bayar" value="{{ old('tgl_bayar') }}">
                                @error('tgl_bayar')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>  

                        <br>
                        <!-- untuk tombol simpan -->
                        
                        <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Bayar">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pembayaran/viewkeranjang') }}" role="button">Batal</a>
                        
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
		
		
		
        
@endsection