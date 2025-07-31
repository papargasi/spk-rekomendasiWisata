@extends('layout')
@section('tittle','Konfigurasi peta')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konfigurasi Peta OWI</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color:grey">Home</a></li>
                        <li class="breadcrumb-item active">Konfigurasi Peta OWI</li>
                    </ol>
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
                                        const wisataList = @json($wisataData ?? []);
                                        wisataList.forEach((wisata) => {
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
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
