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
            <h5 class="card-title fw-semibold mb-4">Data Layanan</h5>

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
                <form action="{{ route('layanan.store') }}" method="post">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="idlayananlabel">ID LAYANAN</label>
                        <input class="form-control form-control-solid" id="id_layanan_tampil" name="id_layanan_tampil" type="text" placeholder="Contoh: LYN-001" value="{{$id_layanan}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="id_layanan" name="id_layanan" value="{{$id_layanan}}">

                    <!-- Layanan -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Layanan</label>
                        <input type="text" class="form-control form-control-solid" id="nama_layanan" name="nama_layanan" placeholder="Contoh: Cuci Kering" value="{{ old('nama_layanan') }}">
                    </div>

                    <!-- Jenis Layanan -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan</label>
                        <select name="jenis_layanan" class="form-select" aria-label="Default select example">
                          <option selected>Open this select menu</option>
                          <option value="Regular">Regular</option>
                          <option value="Express">Express</option>
                        </select>
                    </div>

                        <!-- Tarif -->
                        <div class="mb-3">
                            <label for="harga" class="form-label">Tarif</label>
                            <input type="text" class="form-control form-control-solid" id="harga" name="harga" placeholder="Contoh: 20000" value="{{ old('harga') }}">
                        </div>

                    <!-- deskripsi -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control form-control-solid" id="deskripsi" name="deskripsi" placeholder="Contoh: Cuci kering adalah layanan pencucian tanpa menggunakan air sama sekali. Pencucian reguler dapat mencuci pakaian biasa dan pakaian dengan kain khusus." value="{{ old('deskripsi') }}"></textarea>
                    </div>

                    <!-- untuk tombol simpan -->
                    
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/layanan') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
    </div>
		
		
		
        
@endsection