@extends('layout')
@section('tittle', '| Edit Objek Wisata')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6 mb-2">
                <h1 class="m-0">Edit informasi <br><b>{{$data->nama}}</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/"  class="text-decoration-none" style="color:grey">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/dataOwi"  class="text-decoration-none" style="color:grey">Tabel data OWI</a></li>
                    <li class="breadcrumb-item  active"><a href="{{route('wisata.detail',['id'=>$data->id])}}"  class="text-decoration-none" style="color:grey">Detail data {{$data->nama}}</a></li>
                    <li class="breadcrumb-item  active">Edit informasi {{$data->nama}}</li>
                </ol>
            </div>
        
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 h-100">
                    <a href="{{route('wisata.detail',['id'=>$data->id])}}"  class="text-decoration-none" style="color:black">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1" id="times-icon"><i class="fas fa-times"></i></span>
                            <div class="info-box-content equal-box">
                                <span class="info-box-number" id="edit-text">Kembali</span>
                                <span class="info-box-text" id="edit-text-kecil">Ketuk untuk Membatalkan</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahFoto">
                            Tambah Foto
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 table table-responsive">
                            <table class="table table-noborder">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Input</th>
                                        <th colspan="2" align="left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->foto as $foto)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $foto->nm_foto) }}"
                                                 style="width: 100px; border-radius: 10px; cursor: pointer;"
                                                 alt="{{ $foto->nm_foto }}"
                                                 onclick="showImage(this.src)">
                                        </td>
                                        <td>
                                            <form action="{{ route('foto.update', ['id' => $foto->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="file" name="foto" class="form-control mb-2" required>
                                               
                                        </td>
                                        <td>
                                             <button type="submit" class="btn btn-sm btn-warning">Update Foto</button>
                                            </form>
                                            <form action="{{ route('foto.delete', ['id' => $foto->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Foto -->
<div class="modal fade" id="modalTambahFoto" tabindex="-1" role="dialog" aria-labelledby="modalTambahFotoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('foto.tambah', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahFotoLabel">Tambah Foto Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="foto">Pilih Foto</label>
                  <input type="file" class="form-control" name="foto" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Unggah</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal detal foto -->
<div id="imgModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.8); justify-content:center; align-items:center; transition:opacity 0.3s;">
    <span onclick="closeModal()" style="position:absolute; top:20px; right:30px; color:white; font-size:40px; cursor:pointer;">&times;</span>
    <img id="modalImage" src="" style="max-width:90%; max-height:90%; border-radius:10px;">
</div>

                    
                                                

<script>
    const data = @json($data);
    console.log(data)

    function showImage(src) {
        const modal = document.getElementById('imgModal');
        const modalImg = document.getElementById('modalImage');
        modalImg.src = src;
        modal.style.display = 'flex';
        modal.style.opacity = '0';
        setTimeout(() => modal.style.opacity = '1', 10);
    }

    function closeModal() {
        const modal = document.getElementById('imgModal');
        modal.style.opacity = '0';
        setTimeout(() => modal.style.display = 'none', 300);
    }

    // Optional: close modal on background click
    document.getElementById('imgModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>
@endsection
