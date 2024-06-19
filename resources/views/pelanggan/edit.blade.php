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
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
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
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Pelanggan</h5>

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

                <!-- Awal Dari Input Form -->
                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <fieldset disabled>
                        <div class="mb-3"><label for="pelangganidlabel">Id Pelanggan</label>
                        <input class="form-control form-control-solid" id="id_pelanggan_tampil" name="id_pelanggan_tampil" type="text" placeholder="Contoh: PR-001" value="{{$pelanggan->id_pelanggan}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="{{$pelanggan->id_pelanggan}}">
                    
                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                      <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                      <input type="text" class="form-control form-control-solid" id="nama_pelanggan" name="nama_pelanggan" placeholder="Contoh: John Doe" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
                    </div>

                    <!-- Nomor Telepon Pelanggan -->
                    <div class="mb-3">
                      <label for="no_telp_pelanggan" class="form-label">Nomor Telepon</label>
                      <input type="text" class="form-control form-control-solid" id="no_telp_pelanggan" name="no_telp_pelanggan" placeholder="Contoh: 081234567890" value="{{ old('no_telp_pelanggan', $pelanggan->no_telp_pelanggan) }}">
                    </div>

                    <!-- Alamat Pelanggan -->
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat Pelanggan</label>
                      <textarea class="form-control form-control-solid" id="alamat" name="alamat" rows="3" placeholder="Contoh: Jl. Bunga Matahari No. 16">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    </div>

                    <!-- Jenis Kelamin Pelanggan -->
                    <div class="mb-3">
                      <label class="form-label">Jenis Kelamin</label>
                      <select name="jenis_kelamin_pelanggan" class="form-select" aria-label="Default select example">
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                      </select>
                  </div>
                    <!-- untuk tombol simpan -->
                    
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pelanggan') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
		
		
		
        
@endsection