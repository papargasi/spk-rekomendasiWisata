<!-- isi halaman index -->

@extends('layout')
@section('tittle','| Dashboard')
@section('content')
      <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/" class="nav-link">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid"> <!--s-->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-home"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total OWI</span>
                <span class="info-box-number">
                  {{$totalOwi}} Places
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-star"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Rata rata penilaian</span>
                <span class="info-box-number">
                  {{$avgPenilaian}}<sup>⭐</sup>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-image"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Galeri OWI</span>
                <span class="info-box-number">
                  {{$totalGaleri}} images
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Titik objek wisata se-Ciayumajakuning</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  Naro map disini a bud
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
            @foreach ($data as $wisata)
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Galeri {{ $wisata->nama }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($wisata->foto && count($wisata->foto) > 0)
                                <div class="d-flex flex-wrap overflow-auto" style="max-height: 340px; gap: 10px;">
                                    @foreach ($wisata->foto as $f)
                                        <div style="flex: 0 0 48%;">
                                            <img src="{{ asset('storage/wisata/' . $f->nm_foto) }}" alt="foto"
                                                class="img-fluid rounded shadow-sm mb-2"
                                                style="height: 150px; width: 100%;; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                    <p class="text-muted text-center mb-0">
                                        Galeri <strong>{{ $wisata->nama }}</strong> belum mempunyai foto.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
    </div>
@endsection