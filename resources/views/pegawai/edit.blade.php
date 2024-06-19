@extends('layoutbootstrap')

@section('konten')


<!--  Main wrapper -->
<div class="body-wrapper">

  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Data Pegawai</h5>

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
        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post">
          @csrf
          <fieldset disabled>
            <div class="mb-3"><label for="kodepegawailabel">Kode pegawai</label>
              <input class="form-control form-control-solid" id="kode_pegawai_tampil" name="kode_pegawai_tampil" type="text" placeholder="PR-001" readonly>
            </div>
          </fieldset>
          <input type="hidden" id="kode_pegawai" name="kode_pegawai" value="{{$pegawai->kode_pegawai}}">

          <div class="mb-3"><label for="namapegawailabel">Nama pegawai</label>
            <input class="form-control form-control-solid" id="nama_pegawai" name="nama_pegawai" type="text" placeholder="Masukan Nama Kamu" value="{{$pegawai->nama_pegawai}}">
          </div>

          <div class="mb-0"><label for="alamatpegawailabel">Alamat pegawai</label>
            <textarea class="form-control form-control-solid" id="alamat" name="alamat" rows="3" placeholder="Cth: Jl Pelajar Pejuan 45">{{$pegawai->alamat}}</textarea>
          </div>

          <div class="mb-3">
            <label for="jeniskelaminlabel">Jenis Kelamin</label>
            <select class="form-control form-control-solid" id="jenis_kelamin_pegawai" name="jenis_kelamin_pegawai">
              <option value="Laki-laki" {{ $pegawai->jenis_kelamin_pegawai == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $pegawai->jenis_kelamin_pegawai == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>


          <div class="mb-3"><label for="nohplabel">Nomor HP</label>
            <input class="form-control form-control-solid" id="no_telp_pegawai" name="no_telp_pegawai" type="number" placeholder="081234567890" value="{{$pegawai->no_telp_pegawai}}">
          </div>

          <br>
          <!-- untuk tombol simpan -->

          <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

          <!-- untuk tombol batal simpan -->
          <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pegawai') }}" role="button">Batal</a>

        </form>
        <!-- Akhir Dari Input Form -->

      </div>
    </div>
  </div>


  @endsection