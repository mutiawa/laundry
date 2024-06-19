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
                  <h5 class="card-title fw-semibold mb-4">Buku Besar</h5>
                  <div class="card">

                        <!-- Lokasi Buku Besar -->
                            <!-- Filter Periode Buku Besar -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">Pilih Periode</div>
                                            <div class="col-sm-9"><input type="month" class="form-control" name="periode" id="periode" onchange="proses()"></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3">Pilih Akun</div>
                                            <div class="col-sm-9">
                                                <select name="id_akun" id="id_akun" class="form-control" onchange="proses()" required>
                                                    <option value="" disabled selected>- - - Pilih Akun - - -</option>
                                                    @foreach ($akun as $ak)                   
                                                        <option value="{{$ak->kode_akun}}-{{$ak->nama_akun}}">{{$ak->nama_akun}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Filter Periode Buku Besar -->
                            <br>
                            <!-- Awal Tabel Buku Besar -->
                            <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <div id="xperusahaan"></div>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <div id="xbukubesar"></div>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <div id="xperiode"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="responsive-table-plugin">
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive" data-pattern="priority-columns">
                                                    <table id="report" class="table table-bordered nowrap">
                                                        <thead class="thead-dark">
                                                            <tr bgcolor="#dbd7d7">
                                                                <th rowspan="2">Tanggal</th>
                                                                <th rowspan="2">Nama Akun</th>
                                                                <th rowspan="2" class="text-center">Debet</th>
                                                                <th rowspan="2" class="text-center">Kredit</th>
                                                                <th colspan="2" class="text-center">Saldo </th>
                                                            </tr>
                                                            <tr bgcolor="#dbd7d7">
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
                            <!-- Akhir Tabel Buku Besar -->

                        <!-- Akhir Lokasi Buku Besar -->

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
            var akun = document.getElementById("id_akun").value; //format 111-Kas
            var position = akun.search("-"); //mencari posisi indeks "-"
            var idakun = akun.substring(0,position); //mendapatkan id akun
            var namaakun = akun.substring(position+1); //mendapatkan namakun
            var periode_tampil = rubah(periode);
            var url = "{{url('jurnal/viewdatabukubesar/')}}";
            var url2 = url.concat("/",periode,"/",idakun);
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

                        // xbukubesar
                        var awalanbukubesar = "Buku Besar ";
                        // console.log(tebal.concat(awalanbukubesar,namaakun,akhirtebal));
                        document.getElementById("xbukubesar").innerHTML = tebal.concat(awalanbukubesar,namaakun,akhirtebal);


                        // mengisi tabel
                        $('tbody').html("");
                        // untuk saldo awal
                        if(response.posisi=='d'){
                            $('tbody').append('<tr>\
                                <td>-</td>\
                                <td><b>Saldo Awal</b></td>\
                                <td>-</td>\
                                <td>-</td>\
                                <td style="text-align:right;">Rp ' + number_format(response.saldoawal) + '</td>\
                                <td style="text-align:right;">-</td>\
                                \</tr>');
                            var saldo_debet = response.saldoawal;
                            var saldo_kredit = 0;
                        }else{
                            $('tbody').append('<tr>\
                                <td>-</td>\
                                <td><b>Saldo Awal</b></td>\
                                <td>-</td>\
                                <td>-</td>\
                                <td style="text-align:right;">-</td>\
                                <td style="text-align:right;">Rp ' + number_format(response.saldoawal) + '</td>\
                                \</tr>');
                            var saldo_debet = 0;
                            var saldo_kredit =  response.saldoawal;
                        }
                        
                        // untuk isi tabel
                        var d = 0;
                        var c = 0
                        $.each(response.bukubesar, function (key, item) {
                            var tgljurnal = item.tgl_jurnal.substring(0, 10); //YYYY-MM-DD
                            
                            if((response.posisi=='d')&&(item.posisi_d_c=='d')){
                                saldo_debet = saldo_debet  + item.nominal;
                                d = d + item.nominal;
                                $('tbody').append('<tr>\
                                    <td class="text-center">' + tgljurnal + '</td>\
                                    <td>' + item.nama_akun + '</td>\
                                    <td style="text-align:right;">Rp ' + number_format(item.nominal) + '</td>\
                                    <td></td>\
                                    <td style="text-align:right;">Rp ' + number_format(saldo_debet) + '</td>\
                                    <td style="text-align:right;">-</td>\
                                    \</tr>');
                            }else if((response.posisi=='d')&&(item.posisi_d_c=='c')){
                                saldo_debet = saldo_debet  - item.nominal;
                                c = c + item.nominal;
                                $('tbody').append('<tr>\
                                    <td class="text-center">' + tgljurnal + '</td>\
                                    <td>' + item.nama_akun + '</td>\
                                    <td></td>\
                                    <td style="text-align:right;">Rp ' + number_format(item.nominal) + '</td>\
                                    <td style="text-align:right;">Rp ' + number_format(saldo_debet) + '</td>\
                                    <td style="text-align:right;">-</td>\
                                    \</tr>');
                            }else if((response.posisi=='c')&&(item.posisi_d_c=='d')){
                                saldo_kredit = saldo_kredit  - item.nominal;
                                c = c + item.nominal;
                                $('tbody').append('<tr>\
                                    <td class="text-center">' + tgljurnal + '</td>\
                                    <td>' + item.nama_akun + '</td>\
                                    <td style="text-align:right;">Rp ' + number_format(item.nominal) + '</td>\
                                    <td></td>\
                                    <td style="text-align:right;"></td>\
                                    <td style="text-align:right;">Rp ' + number_format(saldo_kredit) + '</td>\
                                    \</tr>');
                            }else if((response.posisi=='c')&&(item.posisi_d_c=='c')){
                                saldo_kredit = saldo_kredit  + item.nominal;
                                c = c + item.nominal;
                                $('tbody').append('<tr>\
                                    <td class="text-center">' + tgljurnal + '</td>\
                                    <td>' + item.nama_akun + '</td>\
                                    <td></td>\
                                    <td style="text-align:right;">Rp ' + number_format(item.nominal) + '</td>\
                                    <td style="text-align:right;"></td>\
                                    <td style="text-align:right;">Rp ' + number_format(saldo_kredit) + '</td>\
                                    \</tr>');
                            }
                        });

                        // footer saldo akhir
                        $('tbody').append('<tr bgcolor="#dbd7d7">\
                            <td>-</td>\
                            <td><b>Saldo Akhir</b></td>\
                            <td class="text-right">-</td>\
                            <td class="text-right">-</td>\
                            <td style="text-align:right;">Rp ' + number_format(saldo_debet) + '</td>\
                            <td style="text-align:right;">Rp ' + number_format(saldo_kredit) + '</td>\
                            \</tr>');
                    }
                }
            });
        }
    </script>
    <!-- Akhir Proses Jurnal -->

@endsection