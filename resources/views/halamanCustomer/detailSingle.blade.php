@extends('halamanCustomer.layout')
@section('content')
<div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>{{ $data->nama }}</h1>
              <p class="mb-0">{{ $data->deskripsi }}</p>
              <a href="#galery" class="cta-btn">Selengkapnya<br></a>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="/customer">Home</a></li>
            <li class="current">Gallery Single</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Gallery Details Section -->
    <section id="gallery-details" class="gallery-details section">

      <div class="container" data-aos="fade-up">

        <div class="portfolio-details-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>

          <div class="swiper-wrapper align-items-center" id="galery">
            @foreach ($data->foto as $item)
              <div class="swiper-slide">
                <div class="slide-image-wrapper">
                  <img src="{{ asset('storage/'.$item->nm_foto) }}" alt="">
                </div>
              </div>
            @endforeach
          </div>

          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          <div class="swiper-pagination"></div>
        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8" data-aos="fade-up">
            <div class="portfolio-description">
              <h2>{{ $data->nama }}</h2>
              <p>{{$data->deskripsi}}</p>

              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Disini tempat naro map bud</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>

            </div>
          </div>

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="portfolio-info">
              <h3>Tentang <strong>{{ $data->nama }}</strong></h3>
              <ul>
                <li><strong>Alamat</strong> <p id="lokasi-text">Memuat lokasi...</p></li>
                <li><strong>Rating</strong> {{ $data->rating }}⭐</li>
                <li><a href="#" class="btn-visit align-self-start">Visit Website</a></li>
              </ul>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Gallery Details Section -->
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
    </script>
    @endsection