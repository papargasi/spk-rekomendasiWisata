@extends('layout')
@section('tittle', '| Tambah data')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6 mb-2">
                <h1><strong>Tambah data objek wisata</strong></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none" style="color:grey">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dataOwi" class="text-decoration-none" style="color:grey">Tabel data OWI</a></li>
                    <li class="breadcrumb-item active">Tambah data OWI</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container mt-5">
    <div class="card">
    <div id="stepper" class="bs-stepper">
        <div class="card-head">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#info-step">
                    <button type="button" class="step-trigger" role="tab">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Info Wisata</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#foto-step">
                    <button type="button" class="step-trigger" role="tab">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Upload Foto</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#map-step">
                    <button type="button" class="step-trigger" role="tab">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Titik Koordinat</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <!-- Step 1 -->
                    <div id="info-step" class="content" role="tabpanel">
                        <div class="mb-3">
                            <label>Nama Objek Wisata</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Wisata</label>
                            <input type="text" class="form-control" name="jenis" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="stepper.next()">Lanjut</button>
                    </div>
    
                    <!-- Step 2 -->
                    <div id="foto-step" class="content" role="tabpanel">
                        <div class="mb-3">
                            <label>Upload Foto Objek Wisata</label>
                            <input type="file" name="foto[]" multiple class="form-control" id="fotoInput" accept="image/*">
                            <small class="text-muted">Pilih satu per satu. Semua gambar akan ditampilkan di bawah.</small>
                        </div>

                        <!-- Counter -->
                        <div class="mb-2">
                            <strong>Total Foto: <span id="fotoCounter">0</span></strong>
                        </div>

                        <!-- Scrollable table -->
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                    <table class="table m-0 table-striped table-sm" id="fotoTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 120px;">Preview</th>
                                                <th>Nama File</th>
                                                <th style="width: 80px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="noFotoRow">
                                                <td colspan="3" class="text-center text-muted">Belum ada foto objek terpilih</td>
                                            </tr>
                                            <!-- Baris akan ditambahkan via JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                                
                        <!-- Hidden input container -->
                        <div id="fotoHiddenContainer"></div>

                        <button type="button" class="btn btn-secondary mt-3" onclick="stepper.previous()">Sebelumnya</button>
                        <button type="button" class="btn btn-primary mt-3" onclick="stepper.next()">Lanjut</button>
                    </div>
    
                    <!-- Step 3 -->
                    <div id="map-step" class="content" role="tabpanel">
                        <p>Klik pada peta untuk menentukan lokasi objek wisata:</p>
                        <div id="map" style="height: 400px;"></div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary" onclick="stepper.previous()">Sebelumnya</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
    </div>
</div>

{{-- Leaflet JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- Step Navigation Script + Map --}}
<script>
    let map;
    let marker;
    let mapInitialized = false;

    document.addEventListener('DOMContentLoaded', function () {
        stepper = new window.Stepper(document.querySelector('#stepper'));

        // Deteksi saat tombol ke step peta diklik
// Gunakan event 'shown.bs-stepper' untuk mendeteksi saat step 3 benar-benar aktif
document.querySelector('#stepper').addEventListener('shown.bs-stepper', function (event) {
    const targetStep = event.detail.indexStep; // index 0 = info, 1 = foto, 2 = map

    if (targetStep === 2) {
        setTimeout(() => {
            if (!mapInitialized) {
                initMap();
                setTimeout(() => {
                    map.invalidateSize();
                }, 300);
            } else {
                map.invalidateSize();
            }
        }, 300); // beri delay setelah DOM tampil
    }
});
    });

    function initMap() {
        map = L.map('map').setView([-6.75, 108.4], 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        map.on('click', function (e) {
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

        mapInitialized = true;
    }

// script pengurus gammbar
let fotoFiles = [];

    document.getElementById('fotoInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            fotoFiles.push(file);
            updateFotoTable();
        }
        e.target.value = ''; // agar bisa pilih file yang sama lagi
    });

    function updateFotoTable() {
        const tableBody = document.querySelector('#fotoTable tbody');
        const hiddenContainer = document.getElementById('fotoHiddenContainer');
        const fotoCounter = document.getElementById('fotoCounter');

        tableBody.innerHTML = '';
        hiddenContainer.innerHTML = '';
        fotoCounter.textContent = fotoFiles.length;

        if (fotoFiles.length === 0) {
            const row = document.createElement('tr');
            row.id = 'noFotoRow';
            row.innerHTML = `
                <td colspan="3" class="text-center text-muted">Belum ada foto objek terpilih</td>
            `;
            tableBody.appendChild(row);
            return;
        }

        fotoFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><img src="${e.target.result}" class="img-thumbnail" width="100"/></td>
                    <td>${file.name}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeFoto(${index})">Hapus</button>
                    </td>
                `;
                tableBody.appendChild(row);
            };
            reader.readAsDataURL(file);

            // Hidden input untuk form
            const dt = new DataTransfer();
            dt.items.add(file);
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'foto[]';
            input.files = dt.files;
            input.style.display = 'none';
            hiddenContainer.appendChild(input);
        });
    }

    function removeFoto(index) {
        fotoFiles.splice(index, 1);
        updateFotoTable();
    }


</script>

@endsection
