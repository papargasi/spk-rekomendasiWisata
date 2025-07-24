@extends('layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Wisata Ciayumajakuning - Peta Gratis</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    #map { height: 500px; width: 100%; margin-top: 10px; }
    #info { margin-top: 10px; }
  </style>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>

<h2>Peta Wisata Ciayumajakuning (Gratis Tanpa Google)</h2>
<p>Wilayah: Cirebon, Indramayu, Majalengka, Kuningan, Subang</p>

<div id="map"></div>
<div id="info"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  const map = L.map('map').setView([-6.75, 108.4], 9); // Tengah Ciayumajakuning

  // Tambahkan tile OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Lokasi asal default (Kota Cirebon)
  const origin = L.latLng(-6.732023, 108.552315);
  L.marker(origin).addTo(map).bindPopup("Lokasi Anda (Cirebon)").openPopup();

  // Daftar lokasi wisata (contoh dummy, bisa kamu ganti)
  const wisataList = [
    {
      nama: "Keraton Kasepuhan",
      kota: "Cirebon",
      lat: -6.739660,
      lon: 108.574396,
      rating: 4.6,
      gambar: "https://via.placeholder.com/150"
    },
    {
      nama: "Pantai Balongan Indah",
      kota: "Indramayu",
      lat: -6.321972,
      lon: 108.373794,
      rating: 4.2,
      gambar: "https://via.placeholder.com/150"
    },
    {
      nama: "Curug Ibun Pelangi",
      kota: "Majalengka",
      lat: -6.835416,
      lon: 108.326273,
      rating: 4.8,
      gambar: "https://via.placeholder.com/150"
    },
    {
      nama: "Telaga Remis",
      kota: "Kuningan",
      lat: -6.902081,
      lon: 108.474619,
      rating: 4.4,
      gambar: "https://via.placeholder.com/150"
    },
    {
      nama: "Capolaga Adventure Camp",
      kota: "Subang",
      lat: -6.706179,
      lon: 107.686579,
      rating: 4.7,
      gambar: "https://via.placeholder.com/150"
    }
  ];

  // Tampilkan semua marker wisata
  wisataList.forEach((wisata) => {
    const dest = L.latLng(wisata.lat, wisata.lon);

    const marker = L.marker(dest).addTo(map).bindPopup(`
      <b>${wisata.nama}</b><br>
      Lokasi: ${wisata.kota}<br>
      Rating: ${wisata.rating} ⭐<br>
      <img src="${wisata.gambar}" width="150" />
    `);

    // Garis & jarak dari origin ke setiap lokasi
    fetch(`https://router.project-osrm.org/route/v1/driving/${origin.lng},${origin.lat};${dest.lng},${dest.lat}?overview=false`)
      .then(res => res.json())
      .then(route => {
        if (route.routes && route.routes.length > 0) {
          const distance = route.routes[0].distance / 1000;
          const duration = route.routes[0].duration / 60;

          const popupContent = `
            <b>${wisata.nama}</b><br>
            Lokasi: ${wisata.kota}<br>
            Rating: ${wisata.rating} ⭐<br>
            <img src="${wisata.gambar}" width="150" /><br>
            <strong>Jarak:</strong> ${distance.toFixed(1)} km<br>
            <strong>Waktu tempuh:</strong> ${duration.toFixed(1)} menit
          `;
          marker.bindPopup(popupContent);
        }
      });
  });
</script>

</body>
</html>

@endsection
