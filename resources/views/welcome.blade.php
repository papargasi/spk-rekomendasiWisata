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
                  <div id="map" style="height: 300px; width: 100%; margin-top: 10px;"></div>
                  <script>
                    document.addEventListener("DOMContentLoaded", function () {
                      const map = L.map('map').setView([-6.75, 108.4], 9);
                      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                      }).addTo(map);
                        
                      let origin;
                      if (navigator.geolocation) {
                          navigator.geolocation.getCurrentPosition(function (position) {
                              const lat = position.coords.latitude;
                              const lng = position.coords.longitude;
                              origin = L.latLng(lat, lng);
                              // L.marker(origin).addTo(map).bindPopup("<strong>Ini lokasi mu yak😁</strong>").openPopup(); ← hapus ini
                              map.setView(origin, 12);
                              tampilkanWisata(origin);
                          }, function (error) {
                              alert("Gagal mendapatkan lokasi: " + error.message);
                              setDefaultOrigin();
                          });
                      } else {
                          alert("Browser tidak mendukung geolokasi.");
                          setDefaultOrigin();
                      }
                      function setDefaultOrigin() {
                          origin = L.latLng(-6.732023, 108.552315);
                          // L.marker(origin).addTo(map).bindPopup("Lokasi Default (Cirebon)").openPopup(); ← hapus ini juga
                          map.setView(origin, 11);
                          tampilkanWisata(origin);
                      }
                      
                      function tampilkanWisata(origin) {
                        const wisataList = @json($wisataData ?? []);
                        console.log(wisataList);
                        wisataList.forEach((wisata) => {
                          const dest = L.latLng(wisata.latitude, wisata.longitude);
                          const gambar = wisata.foto_utama ? wisata.foto_utama.nm_foto : null;
                          const marker = L.marker(dest).addTo(map).bindPopup();
                          fetch(`https://router.project-osrm.org/route/v1/driving/${origin.lng},${origin.lat};${dest.lng},${dest.lat}?overview=false`)
                          .then(res => res.json())
                          .then(route => {
                            if (route.routes && route.routes.length > 0) {
                              const distance = route.routes[0].distance / 1000;
                              const duration = route.routes[0].duration / 60;
                              
                              const popupContent = `
                              <b>${wisata.nama}</b><br>
                              Rating: ${wisata.rating} ⭐<br>
                              <img src="{{asset('storage/${gambar}')}}" alt="${gambar}" width="150px" style="margin-bottom:5px;border-radius:15px"><br>
                              <strong style="">Jarak:</strong> ${distance.toFixed(1)} km<br>
                              <strong>Waktu tempuh:</strong> ${duration.toFixed(1)} menit
                              `;
                              marker.bindPopup(popupContent);
                            }
                          });
                        });
                      }
                    });
                  </script>
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
                                            <img src="{{ asset('storage/' . $f->nm_foto) }}" alt="{{$f->nm_foto}}"
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