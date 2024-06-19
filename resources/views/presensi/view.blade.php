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
                        <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank"
                            class="btn btn-primary">Download Free</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35"
                                    height="35" class="rounded-circle">
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
                                    <a href="./authentication-login.html"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                                <h5 class="card-title fw-semibold mb-4">Presensi</h5>
                                <div class="card">

                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Master Data Presensi</h6>

                                        <!-- Tombol Tambah Data -->
                                        <button class="btn btn-primary btn-icon-split btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#tambahDataModal">
                                            <span class="icon text-white-50">
                                                <i class="ti ti-plus"></i>
                                            </span>
                                            <span class="text">Tambah Data</span>
                                        </button>
                                        <!-- Akhir Tombol Tambah Data -->

                                    </div>

                                    <div class="card-body">
                                        <!-- Awal Dari Tabel -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Kode Presensi</th>
                                                        <th>Nama Pegawai</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot class="thead-dark">
                                                    <tr>
                                                        <th>Kode Presensi</th>
                                                        <th>Nama Pegawai</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    @php
                                                        $totalsPerPegawai = [];
                                                    @endphp

                                                    @foreach ($presensi as $pres)
                                                        <tr>
                                                            <td>{{ $pres->kode_presensi }}</td>
                                                            <td>{{ $pres->nama_pegawai }}</td>
                                                            <td>{{ $pres->check_in }}</td>
                                                            <td>{{ $pres->updated_at }}</td>
                                                            <td>
                                                                <a href="#"
                                                                    onclick="deleteConfirm(this); return false;"
                                                                    data-id="{{ $pres->id }}"
                                                                    class="btn btn-danger btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-minus"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                </a>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Akhir Dari Tabel -->

                                        <!-- Awal Daftar Kehadiran Pegawai -->
                                        <h6 class="mb-3">Daftar Kehadiran Pegawai:</h6>
                                        <ul>
                                            @foreach ($totalsPerPegawai as $pegawai => $total)
                                                <li>{{ $pegawai }}: {{ $total }}</li>
                                            @endforeach
                                        </ul>
                                        <!-- Akhir Daftar Kehadiran Pegawai -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Presensi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                            <form method="POST" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_presensi">Kode presensi</label>
                                    <input class="form-control form-control-solid" id="kode_presensi"
                                        name="kode_presensi" type="text" value="{{ $kode_presensi }}" readonly><br>
                                </div>
                                <!-- Dalam form untuk memasukkan ID pegawai -->
                                <div class="form-group">
                                    <label for="nama_pegawai">Pilih Pegawai</label>
                                    <select class="form-control" id="nama_pegawai" name="nama_pegawai" required>
                                        <option value="" selected disabled>Pilih Pegawai...</option>
                                        @foreach ($pegawais as $pegawai)
                                            <option value="{{ $pegawai['nama_pegawai'] }}">{{ $pegawai['nama_pegawai'] }}</option>
                                        @endforeach
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="check_in">Status Kehadiran:</label>
                                    <select class="form-control" id="check_in" name="check_in" required>
                                        <option value="" selected disabled>...</option>
                                        <option value="hadir">Hadir</option>
                                        <option value="alfa">Alfa</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="izin">Izin</option>
                                    </select>
                                </div><br>

                                <div class="form-group" id="image-upload" style="display: none;">
                                    <label for="image">Unggah Foto: <span style="color: red">*</span></label>
                                    <input type="file" class="form-control-file" id="image" name="image"
                                        required>
                                </div><br>

                                <script>
                                    // Mengubah tampilan input foto berdasarkan pilihan status kehadiran
                                    document.getElementById('check_in').addEventListener('change', function() {
                                        var selectedValue = this.value;
                                        var imageUploadDiv = document.getElementById('image-upload');
                                        if (selectedValue === 'sakit' || selectedValue === 'izin') {
                                            imageUploadDiv.style.display = 'block'; // Menampilkan input foto
                                        } else {
                                            imageUploadDiv.style.display = 'none'; // Menyembunyikan input foto
                                            if (selectedValue === 'hadir' || selectedValue === 'alfa') {
                                                // Jika hadir atau alfa, hilangkan atribut required dari input file
                                                document.getElementById('image').removeAttribute('required');
                                            } else {
                                                // Jika bukan hadir atau alfa, tambahkan atribut required ke input file
                                                document.getElementById('image').setAttribute('required', 'required');
                                            }
                                        }
                                    });
                                </script>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('presensi.index') }}" class="btn btn-dark">Back</a>
                            </form>
                            <!-- Akhir Dari Input Form -->


                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Data -->

            <script>
                function deleteConfirm(e) {
                    var tomboldelete = document.getElementById('btn-delete')
                    id = e.getAttribute('data-id');

                    // const str = 'Hello' + id + 'World';
                    var url3 = "{{ url('presensi/destroy/') }}";
                    var url4 = url3.concat("/", id);
                    // console.log(url4);

                    // console.log(id);
                    // var url = "{{ url('perusahaan/destroy/"+id+"') }}";

                    // url = JSON.parse(rul.replace(/"/g,'"'));
                    tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                    var pesan = "Data dengan ID <b>"
                    var pesan2 = " </b>akan dihapus"
                    var res = id;
                    document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

                    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                        keyboard: false
                    });

                    myModal.show();

                }
            </script>

            <!-- Logout Delete Confirmation-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                x
                            </button>
                        </div>
                        <div class="modal-body" id="xid"></div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

                        </div>
                    </div>
                </div>
            </div>
        @endsection
