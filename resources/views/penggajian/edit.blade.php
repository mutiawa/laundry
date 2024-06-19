@extends('layoutbootstrap')

@section('konten')

<!--  Main wrapper -->
<div class="body-wrapper">

    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Data penggajian</h5>
  
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
          <form action="{{ route('penggajian.update', $penggajian->id ) }}" method="PUT">
            @csrf
            
            <fieldset disabled>
              <div class="mb-3"><label for="kodepenggajianlabel">Kode penggajian</label>
                <input class="form-control form-control-solid" id="kode_penggajian_tampil" name="kode_penggajian_tampil" type="text" placeholder="C-{{$penggajian->id}}" readonly>
              </div>
            </fieldset>
            <input type="hidden" id="kode_penggajian" name="kode_penggajian" value="{{$penggajian->id}}">
  
            <div class="mb-3">
                <label for="nama_pegawai">Nama Pegawai</label>
                <input class="form-control form-control-solid" id="nama_pegawai" name="nama_pegawai" type="text" value="{{ $penggajian->nama_pegawai }}">
            </div>  

            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <input class="form-control form-control-solid" id="alamat" name="alamat" type="text" value="{{ $pegawai->first()->alamat}}">
            </div>

            <div class="mb-3">
              <label for="jeniskelaminlabel">Jenis Kelamin</label>
              <select class="form-control form-control-solid" id="jenis_kelamin_penggajian" name="jenis_kelamin_penggajian" value="{{ $pegawai->first()->jenis_kelamin }}">
                <option value="Laki-laki" {{ $penggajian->jenis_kelamin_penggajian == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $penggajian->jenis_kelamin_penggajian == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
              </select>
            </div>
  
            <div class="mb-3">
                <label for="no_hp">Nomor Hp</label>
                <input class="form-control form-control-solid" id="no_telp_pegaai" name="no_telp_pegaai" type="number" value="{{ $pegawai->first()->no_telp_pegaai }}">
            </div> 
  
            <br>
            <!-- untuk tombol simpan -->
  
            <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">
  
            <!-- untuk tombol batal simpan -->
            <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/penggajian') }}" role="button">Batal</a>
  
          </form>
          <!-- Akhir Dari Input Form -->
  
        </div>
      </div>
    </div>
  
  
@endsection