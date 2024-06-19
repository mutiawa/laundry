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
                  <h5 class="card-title fw-semibold mb-4">Jurnal Umum</h5>
                  <div class="card">

                        <!-- Lokasi Jurnal Umum -->
                            <!-- Filter Periode Jurnal -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">Pilih Periode</div>
                                            <div class="col-sm-9"><input type="month" class="form-control" name="periode" id="periode" onchange="proses()"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Filter Periode Jurnal -->
                            <br>
                            <!-- Awal Tabel Jurnal -->
                            <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <div id="xperusahaan"></div>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <b>Jurnal Umum</b>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <div id="xperiode"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="responsive-table-plugin">
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive" data-pattern="priority-columns">
                                                    <table id="report" class="table table-bordered nowrap">
                                                        <thead class="thead-dark">
                                                            <tr bgcolor="#dbd7d7">
                                                                <th class="text-center">ID Jurnal</th>
                                                                <th class="text-center">Tanggal</th>
                                                                <th class="text-center">Akun</th>
                                                                <th class=" text-center">Reff</th>
                                                                <th class="text-center">Debet</th>
                                                                <th class="text-center">Kredit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- Akhir Tabel Jurnal -->

                        <!-- Akhir Lokasi Jurnal Umum -->

                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
        </div>

    <!-- Proses Jurnal -->
    <script>
        // fungsi number format
        function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

        // fungsi untuk merubah format YYYY-MM menjadi Bulan Tahun
        function rubah(periode){
            // dapatkan tahun
            var tahun = periode.substring(0, 4);
            var bulan = periode.substring(5);
            switch (bulan) {
                case '01':
                    bln = "Januari";
                    break;
                case '02':
                    bln = "Februari";
                    break;
                case '03':
                    bln = "Maret";
                    break;
                case '04':
                    bln = "April";
                    break;
                case '05':
                    bln = "Mei";
                    break;
                case '06':
                    bln = "Juni";
                    break;
                case '07':
                    bln = "Juli";
                    break;
                case '08':
                    bln = "Agustus";
                    break;
                case '09':
                    bln = "September";
                    break;
                case '10':
                    bln = "Oktober";
                    break;
                case '11':
                    bln = "November";
                    break;
                case '12':
                    bln = "Desember";
                    break;
            }
            var hasil = bln.concat(" ",tahun)
            return hasil;
        }

        // fungsi untuk memproses perubahan nilai pada elemen input
        function proses(){
            
            // ambil nilai month dan year dari elemen input dalam format YYYY-MM
            var periode = document.getElementById("periode").value;
            var periode_tampil = rubah(periode);
            var url = "{{url('jurnal/viewdatajurnalumum/')}}";
            var url2 = url.concat("/",periode);
            // console.log(pilihan);
            $.ajax({
                type: "GET",
                url: url2,
                success: function (response) {
                    // console.log(response);
                    if (response.status == 404) {
                        // beri alert kalau gagal
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        // console.log(response);
                        // xperusahaan
                        var tebal = "<b>";
                        var namaperusahaan = response.perusahaan.nama_perusahaan;
                        var akhirtebal = "</b>";
                        document.getElementById("xperusahaan").innerHTML = tebal.concat(namaperusahaan,akhirtebal);

                        //xperiode 
                        var awalanperiode = "Periode ";
                        document.getElementById("xperiode").innerHTML = tebal.concat(awalanperiode,periode_tampil,akhirtebal);

                        // mengisi tabel
                        var total_debet = 0;
                        var total_credit = 0;

                        $('tbody').html("");
                        $.each(response.jurnal, function (key, item) {
                            var kodejurnal = "JR-";
                            var kd_jurnal = kodejurnal.concat(item.id_transaksi);
                            var tgljurnal = item.tgl_jurnal.substring(0, 10); //YYYY-MM-DD
                            if(item.posisi_d_c=='d'){
                                $('tbody').append('<tr>\
                                <td class="text-center">' + kd_jurnal + '</td>\
                                <td class="text-center">' + tgljurnal + '</td>\
                                <td>' + item.nama_akun + '</td>\
                                <td class="text-center">' + item.kode_akun + '</td>\
                                <td style="text-align:right;">Rp ' + number_format(item.nominal) + '</td>\
                                <td class="text-right"></td>\
                                \</tr>');
                                total_debet = total_debet + item.nominal;
                            }else{
                                $('tbody').append('<tr>\
                                <td class="text-center">' + kd_jurnal + '</td>\
                                <td class="text-center">' + tgljurnal + '</td>\
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;' + item.nama_akun + '</td>\
                                <td class="text-center">' + item.kode_akun + '</td>\
                                <td class="text-right"></td>\
                                <td style="text-align:right;">Rp ' + number_format(item.nominal)  + '</td>\
                            \</tr>');
                              total_credit = total_credit + item.nominal;
                            }
                        });
                        $('tbody').append('<tr bgcolor="#dbd7d7">\
                                <th class="text-center" colspan=4>Total</th>\
                                <th style="text-align:right;">Rp '+number_format(total_debet)+'</th>\
                                <th style="text-align:right;">Rp ' + number_format(total_credit)  + '</th>\
                            \</tr>');
                    }
                }
            });
        }
    </script>
    <!-- Akhir Proses Jurnal -->

@endsection