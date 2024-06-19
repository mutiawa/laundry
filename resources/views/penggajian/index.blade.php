@extends('layoutbootstrap')

@section('konten')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    th {
        text-align: center;
        color: #000;
        text-transform: capitalize;
        font-family: Arial, Helvetica, sans-serif;
    }

    td {
        text-align: center;
    }

    .card-body {
        background-color: rgb(255, 255, 255);
        border-radius: 1.5rem;
        padding: 2rem;
        size: 6rem;
    }
</style>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <center><h2 class="card-title fw-semibold">Input Penggajian Pegawai</h2></center>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                
                                <form method="POST" action="{{ route('hitungGaji') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_pegawai">Nama Pegawai</label>
                                        <select name="nama_pegawai" id="nama_pegawai" class="form-control">
                                            <option value="">Pilih Nama Pegawai</option>
                                            @foreach ($pegawai as $p)
                                                <option value="{{ $p->kode_pegawai }}">{{ $p->nama_pegawai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Hitung Gaji</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Gaji Per Hari</th>
                                            <th>Jumlah Hari Kerja</th>
                                            <th>Total Gaji</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penggajian as $key => $p) 
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $p->nama_pegawai }}</td>
                                            <td>{{ number_format($p->gaji_pokok, 0, ',', '.') }}</td>
                                            <td>{{ number_format($p->jumlah_hari_kerja, 0, ',', '.') }}</td>
                                            <td>{{ number_format($p->jumlah_gaji, 0, ',', '.') }}</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-success" onclick="editPenggajian('{{ $p->id }}')">Edit</button>
                                                <a class="btn btn-primary" href="{{ route('penggajian.show', $p->id) }}"><i class="fas fa-eye"></i></a>
                                                <button class="btn btn-danger" onclick="confirmDelete('{{ $p->id }}', '{{ $p->nama_pegawai }}')"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <form id="deleteForm" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Penggajian Pegawai</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="edit_nama_pegawai" class="form-label">Pegawai:</label>
                                                    <div name="nama_pegawai" id="edit_nama_pegawai" class="form-select" disabled>
                                                        @foreach ($pegawai as $data)
                                                            <label value="old{{ $data->nama_pegawai }}">{{ $data->nama_pegawai }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_jumlah_hari_kerja" class="form-label">Jumlah Hari Kerja:</label>
                                                    <input type="number" class="form-control" id="edit_jumlah_hari_kerja" name="jumlah_hari_kerja" min="0">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_gaji_pokok" class="form-label">Gaji Pokok:</label>
                                                    <input type="number" class="form-control" id="edit_gaji_pokok" name="gaji_pokok" min="0">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" form="editForm">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function editPenggajian(id) {
                                    // Fetch data using AJAX
                                    $.get('/penggajian/' + id + '/edit', function(data) {
                                        $('#edit_nama_pegawai').val(data.pegawai_id);
                                        $('#edit_jumlah_hari_kerja').val(data.jumlah_hari_kerja);
                                        $('#edit_gaji_pokok').val(data.gaji_pokok);
                                        $('#editForm').attr('action', '/penggajian/' + id);
                                        $('#editModal').modal('show');
                                    });
                                }

                                function confirmDelete(id, nama) {
                                    if (confirm("Apakah Anda yakin ingin menghapus data " + nama + "?")) {
                                        document.getElementById('deleteForm').action = '/penggajian/' + id;
                                        document.getElementById('deleteForm').submit();
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
