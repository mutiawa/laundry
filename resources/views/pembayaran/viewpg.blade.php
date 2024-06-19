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

                <!-- <div class="col-md-12"> -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h5 class="card-title fw-semibold mb-4">Status Pembayaran Payment Gateway</h5>
                </div>
                
                <!-- Awal Status -->
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                        <div class="card-body p-12">
                                <!-- Awal Dari Tabel -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Transaksi</th>
                                                    <th>Tgl Expired</th>
                                                    <th>Tgl Bayar</th>
                                                    <th>Total Harga</th>
                                                    <th>Kode</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Transaksi</th>
                                                    <th>Tgl Expired</th>
                                                    <th>Tgl Bayar</th>
                                                    <th>Total Harga</th>
                                                    <th>Kode</th>
                                                    <th>Status</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($statuspembayaran as $p)
                                                    <tr>
                                                        <td>{{ $p->no_transaksi }}</td>
                                                        <td>{{ $p->tgl_transaksi }}</td>
                                                        <td>{{ $p->tgl_expired }}</td>
                                                        <td>{{ $p->settlement_time }}</td>
                                                        <td style="text-align:right">{{ rupiah($p->total_harga) }}</td>
                                                        <td>{{ $p->status_code }}</td>
                                                        <td>{{ $p->transaction_status }}</td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <!-- Akhir Dari Tabel -->
                        </div>
                        </div>
                    </div>
                <!-- Akhir Status -->

              </div>
            </div>
          </div>
        </div>


@endsection