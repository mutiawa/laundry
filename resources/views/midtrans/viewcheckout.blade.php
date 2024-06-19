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
              <li class="nav-item dropdown">
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
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h5 class="card-title fw-semibold mb-4">Pembayaran Payment Gateway</h5>
                    <div class="card">

                        <!-- dapatkan nomor transaksi -->
                        <?php 
                            $no_transaksi = '';
                            $totaltagihan = 0;
                            
                            foreach($keranjang as $k):
                                $no_transaksi = $k->no_transaksi ;
                                $totaltagihan = $totaltagihan + $k->total ;
                                $id_penjualan = $k->id_penjualan ;
                            endforeach;
                        ?>

                        <!-- Awal Dari Input Form -->
                        <form action="{{ url('midtrans/proses_bayar') }}" id="x-submit-form" method="post">
                            @csrf
                            <input type="hidden" id="id_penjualan" name="id_penjualan" value="{{$id_penjualan}}">
                            <input type="hidden" id="x_json" name="x_json">
                            
                            <fieldset disabled>
                                <div class="mb-3">
                                    <label for="kodeperusahaanlabel">No Transaksi</label>
                                    <input class="form-control form-control-solid" id="kode" name="kode" type="text" value="{{$no_transaksi}}" readonly>
                                </div>
                            </fieldset>    
                            <div class="mb-3"><label for="namaperusahaanlabel">Isi Keranjang <b>({{$totaltagihan}})</b></label>
                                <ul class="list-group">
                                @foreach ($keranjang as $k)
                                    <li class="list-group-item">
                                        <b>{{$k->nama_layanan}}</b> <br>
                                        <div class="row">
                                            {{-- <div class="col-sm-2">
                                                <img width="150px" height="150px" id="x-2" src="{{url('barang')}}/{{$k->foto}}" zn_id="79" title alt="ok">
                                            </div> --}}
                                            <div class="col-sm-10" align="left">
                                                <table>
                                                    <tr>
                                                        <td>
                                                        Harga per item
                                                        </td>
                                                        <td>=</td>
                                                        <td style="text-align:right">{{($k->harga)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        Jumlah Barang
                                                        </td>
                                                        <td>=</td>
                                                        <td style="text-align:right">{{number_format($k->jml_kg)}}</td>
                                                        
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
                                                            {{($k->total)}}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </li>
                                @endforeach
                                </ul>
                            </div>

                            <br>
                            <!-- untuk tombol simpan -->
                            
                            <input class="col-sm-1 btn btn-success btn-sm" value="Bayar" id="pay-button">

                            <!-- untuk tombol batal simpan -->
                            <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('midtrans/bayar') }}" role="button">Batal</a>
                            
                        </form>
                        <!-- Akhir Dari Input Form -->
                    
                    </div>
                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
        </div>

<!-- Untuk Pemrosesan Midtrans -->
<!-- Untuk Midtrans -->
<script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        // window.snap.pay('TRANSACTION_TOKEN_HERE');
        window.snap.pay('{{$snap_token}}',
            {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        // alert("payment success!"); console.log(result);
                        isi_formulir(result);
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        // alert("wating your payment!"); console.log(result);
                        isi_formulir(result);
                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        // alert("payment failed!"); console.log(result);
                        isi_formulir(result);
                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
            }
        );
        // customer will be redirected after completing payment pop-up
      });

    //   fungsi untuk mengirim response call back
        function isi_formulir(result){
            document.getElementById('x_json').value = JSON.stringify(result);
            //alert(document.getElementById('x_json').value);
            $('#x-submit-form').submit();
        }
</script>
<!-- Akhir Pemrosesan Midtrans -->

@endsection