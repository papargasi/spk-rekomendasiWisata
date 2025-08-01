@extends('layout')
@section('tittle', '| Detail Objek Wisata')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6 mb-2">
                <h1>Detail data <strong>{{ $data->nama }}</strong></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color:grey">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dataOwi" style="color:grey" class="text-decoration-none">Tabel data OWI</a></li>
                    <li class="breadcrumb-item  active">Detail data {{$data->nama}}</li>
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
          @if($data->foto->isNotEmpty())
              <img class="profile-user-img img-fluid img-circle"
                  src="{{ asset('storage/'.$data->foto[0]->nm_foto) }}"
                  alt="User profile picture"
                  style="width: 128px; height: 128px; object-fit: cover;">
          @endif
          </div>
  
          <h3 class="profile-username text-center">{{ $data->nama }}</h3>
  
          <p class="text-muted text-center">Objek wisata Ciayumajakuning</p>
  
          <button class="btn btn-success btn-block" onclick="openModal()"><b>Perbarui data</b></button>
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
  
          <p class="text-muted clamp-2">{{ $data->deskripsi }}</p>
  
          <hr>
          
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>
          <p id="lokasi-text" class="text-muted">Sedang memuat lokasi...</p>

  
          <hr>
  
          <strong><i class="fas fa-star mr-1"></i> Rating</strong>
  
          <p class="text-muted">{{ $data->rating }} / 5</p>
  
          <hr>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <form action="{{ route('owi.delete', ['id' => $data->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data dari Objek wisata {{$data->nama}}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-block">Hapus data OWI</button>
            </form>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9 d-flex flex-column">
      <div class="card flex-grow-1 d-flex flex-column">
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

        <!-- FIX HEIGHT + SCROLLABLE BODY -->
        <div class="card-body scrollable-tab-body">
          <div class="tab-content" id="customTabContent">
            <div class="tab-pane fade show active" id="deskripsi" role="tabpanel">
              <h3 class="card-tittle">{{ $data->nama }}</h3>
              <p>{{ $data->deskripsi }}</p>
            </div>
            <div class="tab-pane fade" id="galeri" role="tabpanel">
              @if($data->foto->count())
                  <div class="row">
                      @foreach($data->foto as $foto)
                          <div class="col-md-3 mb-3">
                              <img src="{{ asset('storage/'.$foto->nm_foto) }}"
                                  class="img-fluid rounded shadow-sm"
                                  style="height: 150px; width: 100%; object-fit: cover;">
                          </div>
                      @endforeach
                  </div>
              @else
                  <p class="text-muted">Belum ada foto untuk objek wisata ini.</p>
              @endif
            </div>
            <div class="tab-pane fade" id="peta" role="tabpanel">
              <div class="position-relative mb-4">
                <div id="map" style="height: 500px; width: 100%; margin-top: 10px;"></div>
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
                      const wisata = @json($data); // 1 baris data
                      console.log(wisata);
                      const dest = L.latLng(wisata.latitude, wisata.longitude);
                      const marker = L.marker(dest).addTo(map).bindPopup(`
                        <b>${wisata.nama}</b><br>
                        Rating: ${wisata.rating} ⭐<br>
                        <img src="/storage/${wisata.gambar}" width="150" />
                      `);

                      fetch(`https://router.project-osrm.org/route/v1/driving/${origin.lng},${origin.lat};${dest.lng},${dest.lat}?overview=false`)
                        .then(res => res.json())
                        .then(route => {
                          if (route.routes && route.routes.length > 0) {
                            const distance = route.routes[0].distance / 1000;
                            const duration = route.routes[0].duration / 60;
                            const popupContent = `
                              <b>${wisata.nama}</b><br>
                              Rating: ${wisata.rating} ⭐<br>
                              <img src="/storage/${wisata.gambar}" width="150" /><br>
                              <strong>Jarak:</strong> ${distance.toFixed(1)} km<br>
                              <strong>Waktu tempuh:</strong> ${duration.toFixed(1)} menit
                            `;
                            marker.bindPopup(popupContent);
                          }
                        });
                    }
                  });
                  </script>
                  </div>
              <!-- Leaflet script tetap -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                
<script>
  
  const data = {
    latitude: {{ $data->latitude }},
    longitude: {{ $data->longitude }}
  };

  const lat = data.latitude;
  const lon = data.longitude;

  fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
    .then(response => response.json())
    .then(data => {
      console.log(data); 
      const alamat = data.address;
      const jalan = alamat.road || alamat.town || alamat.village || "";
      const kota = alamat.city || alamat.town || alamat.country || "";
      const kecamatan = alamat.suburb || alamat.city_district || alamat.village || "";
      const lokasi = `${jalan},${kecamatan}, ${kota}`;
      
      document.getElementById("lokasi-text").innerText = lokasi;
    })
    .catch(error => {
      document.getElementById("lokasi-text").innerText = "Lokasi tidak ditemukan";
      console.error("Gagal mengambil lokasi:", error);
    });


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

  // fungsi panggil modal edit
  function openModal() {
    const modal = document.getElementById('updateModal');
    modal.style.display = 'flex';
}

function closeModal(e) {
    const modal = document.getElementById('updateModal');
    modal.classList.remove('animate-fade');
    modal.style.display = 'none';
}
</script>

<!-- Modal -->
<div id="updateModal" class="custom-modal" onclick="closeModal(event)">
    <div class="custom-modal-content animate-fade" onclick="event.stopPropagation()">
        <h3>Edit data objek wisata <br> <b>{{$data->nama}}</b></h3>
        <a href="{{route('wisata.detail.info',['id'=>$data->id])}}" class="btn btn-success w-100 mb-2 py-3 rounded-pill font-weight-bold">Informasi</a>
        <a href="{{route('wisata.detail.rating',['id'=>$data->id])}}" class="btn btn-success w-100 mb-2 py-3 rounded-pill font-weight-bold">Rating</a>
        <a href="{{route('wisata.detail.foto',['id'=>$data->id])}}" class="btn btn-success w-100 mb-2 py-3 rounded-pill font-weight-bold">Foto</a>
    </div>
</div>

@endsection
