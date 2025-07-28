@extends('layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6 mb-2">
                <h1><strong>Detail data {{ $data->nama }} , {{ $data->latitude }}</strong></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" style="color:grey">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dataOwi" style="color:grey">Tabel data OWI</a></li>
                    <li class="breadcrumb-item  active">Tabel data OWI</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $data->nama }}</h3>

                <p class="text-muted text-center">Objek wisata Ciayumajakuning</p>

                <a href="#" class="btn btn-success btn-block"><b>Perbarui data</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tentang <b>{{ $data->nama }}</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-info mr-1"></i> Deskripsi</strong>

                <p class="text-muted">{{ $data->deskripsi }}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-star mr-1"></i> Rating</strong>

                <p class="text-muted">{{ $data->rating }} / 5</p>

                <hr>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
  <div class="card">
    <div class="card-header p-2">
      <ul class="nav nav-pills" id="customTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab">Deskripsi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="galeri-tab" data-toggle="tab" href="#galeri" role="tab">Galeri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="peta-tab" data-toggle="tab" href="#peta" role="tab">Peta</a>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="customTabContent">
        <div class="tab-pane fade show active" id="deskripsi" role="tabpanel">
          <p>Ini konten Deskripsi.</p>
        </div>
        <div class="tab-pane fade" id="galeri" role="tabpanel">
          <p>Ini konten Galeri.</p>
        </div>
        <div class="tab-pane fade" id="peta" role="tabpanel">
          <p>Ini konten Peta.</p>
        </div>
      </div>
    </div>
  </div>
</div>

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <script>
  document.addEventListener("DOMContentLoaded", function () {
    const tabLinks = document.querySelectorAll('#customTab a[data-toggle="tab"]');

    tabLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();

        // Hapus semua class 'active' dari tab-link dan tab-pane
        tabLinks.forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(pane => {
          pane.classList.remove('show', 'active');
        });

        // Tambahkan class 'active' ke tab yang diklik
        this.classList.add('active');

        // Tampilkan tab-pane yang sesuai
        const targetId = this.getAttribute('href');
        const targetPane = document.querySelector(targetId);
        targetPane.classList.add('show', 'active');
      });
    });
  });
</script>

@endsection