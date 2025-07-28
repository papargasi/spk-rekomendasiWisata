@extends('layout')

    @section('content')
        <h2>Peta lokasi tempat wisata <strong>CIAYUMAJAKUNING</strong></h2>
        <p>Wilayah: Cirebon, Indramayu, Majalengka, Kuningan, Subang</p>

        <div id="map" style="height: 500px; width: 100%; margin-top: 10px;"></div>
        <div id="info"></div>

        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        
        <script>
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

        L.marker(origin).addTo(map).bindPopup("<strong>Ini lokasi mu yak😁</strong>").openPopup();
        map.setView(origin, 12); // Zoom ke lokasi pengguna

        // Setelah origin ditentukan, jalankan fungsi tampilkan marker wisata
        tampilkanWisata(origin);
    }, function (error) {
        alert("Gagal mendapatkan lokasi: " + error.message);
        // fallback: pakai Cirebon
        origin = L.latLng(-6.732023, 108.552315);
        L.marker(origin).addTo(map).bindPopup("Lokasi Default (Cirebon)").openPopup();
        tampilkanWisata(origin);
    });
} else {
    alert("Browser tidak mendukung geolokasi.");
    origin = L.latLng(-6.732023, 108.552315);
    L.marker(origin).addTo(map).bindPopup("Lokasi Default (Cirebon)").openPopup();
    tampilkanWisata(origin);
}

// Fungsi menampilkan wisata setelah dapat lokasi user
function tampilkanWisata(origin) {
    const wisataList = @JSON($wisataData);

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

</script>

    @endsection
