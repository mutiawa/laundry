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
                  <h5 class="card-title fw-semibold mb-4">Berita Indonesia Terbaru</h5>

                  <!-- Awal Card Body Galeri Berita -->
                  <div class="album py-5 bg-light">
                        <div class="container">
                        
                        <div class="row">
                            @foreach ($hasil->articles as $p)
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">
                                        <a data-fancybox="gallery" href="{{ $p->urlToImage }}">
                                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap" src="{{ $p->urlToImage }}" width="300" height="200">
                                        </a>
                                        <div class="card-body">
                                            <p class="card-text" style="text-align: justify;">{{$p->description}}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-outline-secondary" href="{{$p->url}}" role="button" target="_blank">View</a>
                                                </div>
                                                <small class="text-muted">{{$p->publishedAt}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                  </div>
                  <!-- Akhir Card Body Galeri Berita -->

                </div>
                
                
              </div>
            </div>
          </div>
        </div>


        

@endsection