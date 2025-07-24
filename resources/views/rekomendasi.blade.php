    @extends('welcome')

    @section('content')
        <h2>Peta Wisata Ciayumajakuning (Gratis Tanpa Google)</h2>
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

    const origin = L.latLng(-6.732023, 108.552315);
    L.marker(origin).addTo(map).bindPopup("Lokasi Anda (Cirebon)").openPopup();

    const wisataList = @json($wisataData); // dari controller Laravel ke JavaScript

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
</script>

    @endsection
