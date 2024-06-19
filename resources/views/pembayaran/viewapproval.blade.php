@extends('layoutbootstrap')

@section('konten')

<!-- Sweet Alert -->
@if(isset($status_hapus))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Hapus Data Berhasil',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
@endif

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

                <!-- <div class="col-md-12"> -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h5 class="card-title fw-semibold mb-4">Approval Pembayaran</h5>
                </div>
                
                    <!-- Awal Dari Tabel -->
                    <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Bayar</th>
                                            <th>Layanan</th>
                                            <th>Bukti Bayar</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Bayar</th>
                                            <th>Layanan</th>
                                            <th>Bukti Bayar</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($statuspembayaran as $p)
                                        <tr>
                                            <td>{{ $p->no_transaksi }}</td>
                                            <td>{{ $p->tgl_bayar }}</td>
                                            <td>{{ $p->list_layanan }}</td>
                                            <td>
                                                <a data-fancybox="gallery" href="{{url('konfirmasi')}}/{{$p->bukti_bayar}}">
                                                    <img src="{{url('konfirmasi')}}/{{$p->bukti_bayar}}" width="150px" height="150px">
                                                </a>
                                                
                                            </td>
                                            <td>{{ $p->total_harga }}</td>
                                            <td>{{ $p->status }}</td>
                                            <td>
                                                <?php 
                                                    if( (!$p->status=='approved') or ($p->status=='menunggu_approve')){
                                                        ?>
                                                            <a href="{{url('pembayaran/approve')}}/{{$p->no_transaksi}}" class="btn btn-success btn-circle" >
                                                                
                                                                <i class="ti ti-pencil"></i>
                                
                                                            </a>

                                                            <a href="#" class="btn btn-danger btn-circle">
                                                                
                                                                    <i class="ti ti-trash"></i>
                                                                
                                                            </a>
                                                        <?php
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    <!-- Akhir Dari Tabel -->

              </div>
            </div>
          </div>
        </div>


@endsection