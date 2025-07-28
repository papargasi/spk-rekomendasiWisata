@extends('layout')

@section('content')
    <div class="container">
        <h2>Tambah Lokasi Wisata</h2>

        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nama Tempat</label>
            <input type="text" name="nama" required><br><br>

            <label>Deskripsi</label>
            <textarea name="deskripsi"></textarea><br><br>

            <label>Rating (0 - 5)</label>
            <input type="number" step="0.1" name="rating" min="0" max="5" required><br><br>

            <label>Gambar</label>
            <input type="file" name="gambar" accept="image/*"><br><br>

            <label>Latitude</label>
            <input type="text" name="latitude" id="latitude" readonly required><br>

            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" readonly required><br><br>

            <div id="map" style="height: 400px; width: 100%; margin-bottom: 20px;"></div>

            <button type="submit">Simpan</button>
        </form>
    </div>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const map = L.map('map').setView([-6.75, 108.4], 9); // Fokus Ciayumajakuning

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(6);
            const lng = e.latlng.lng.toFixed(6);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });
    </script>
@endsection
